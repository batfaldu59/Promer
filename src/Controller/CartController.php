<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Commande;
use App\Entity\CommandeDetail;
use App\Entity\Produit;
use App\Form\CommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/mon-panier", name="app_cart")
     */
    public function index(Cart $cart): Response
    {

        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/remove", name="remove_my_product")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('app_produits');
    }

    /**
     * @Route("/cart/delete/{id}", name="delete_my_product")
     */
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('app_cart');
    }


    /**
     * @Route("/cart/decresse/{id}", name="decresse_my_product")
     */
    public function decresse(Cart $cart, $id): Response
    {
        $cart->decresse($id);
        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/voirpanier", name="app_panier")
     */
    public function monPanier(Cart $cart, Request $req): Response
    {
        if (!$this->getUser()->getAdresses()->getValues()) {
            return $this->redirectToRoute('app_adresse_add');
        }
        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('cart/monPanier.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }

    /**
     * @Route("/voirpanier-recapitulatif", name="app_panier_recap", methods={"POST"})
     */
    public function monRecap(Cart $cart, Request $req): Response
    {

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $commande = new Commande();
            $transporteur = $form->get('transporteur')->getData();
            $delivry = $form->get('adresses')->getData();
            $delivry_content = $delivry->getFirstname().' '.$delivry->getLastname().'<br>';
            $delivry_content.= $delivry->getNumrue().' '.$delivry->getRue();
            if ($delivry->getComplementadresee()) {
                $delivry_content.= '<br>'.$delivry->getComplementadresee();
            }
            $delivry_content.= '<br>'.$delivry->getCodepostal().' '.$delivry->getVille().'-'.$delivry->getPays();
            $commande->setDelivre($delivry_content);
            $commande->setEntreprise($this->getUser());
            $commande->setCreatedAt($date);
            $commande->setTransporteurnom($transporteur->getNom());
            $commande->setTransporteurprix($transporteur->getPrix());
            $commande->setIsPaid(0);
            $this->entityManager->persist($commande);
            foreach ($cart->getFull() as $product) {
                $commandeDetails = new CommandeDetail();
                $commandeDetails->setCommande($commande);
                $commandeDetails->setProduit($product['product']->getNom());
                $commandeDetails->setQuantite($product['quantity']);
                $commandeDetails->setPrix($product['product']->getPrixColis());
                $commandeDetails->setPrix($product['product']->getPrixColis());
                $commandeDetails->setTotal(($product['product']->getPrixColis() + $product['quantity']));
                $this->entityManager->persist($commandeDetails);
            }
            $this->entityManager->flush();
            return $this->render('cart/monRecap.html.twig', [
                'cart' => $cart->getFull(),
                'transporteur' => $transporteur,
                'delivry' => $delivry_content
            ]);
        }
        return $this->redirectToRoute("app_cart");

    }
}
