<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function monPanier(): Response
    {
        return $this->render('cart/monPanier.html.twig');
    }
}
