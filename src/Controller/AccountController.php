<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Adresse;
use App\Entity\Entreprise;
use App\Form\AdresseType;
use App\Form\ChangeInformationsType;
use App\Form\SignupType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/inscription", name="app_signup")
     */
    public function index(Request $req, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em): Response
    {
        $entreprise = new Entreprise();
        $form = $this->createForm(SignupType::class, $entreprise);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entreprise = $form->getData();
            $password = $encoder->encodePassword($entreprise, $entreprise->getPassword());
            $entreprise->setPassword($password);
            $em->persist($entreprise);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('account/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('target_path');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/compte", name="app_compte")
     */
    public function connection()
    {
        return $this->render('account/login.html.twig');
    }

    /**
     * @Route("/compte/modifications-informations", name="app_modifications")
     */
    public function modifications(Request $req, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        $notification = null;
        $entreprise = $this->getUser();
        $form = $this->createForm(ChangeInformationsType::class, $entreprise);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_message = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($entreprise, $old_message)) {
                $new_password = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($entreprise, $new_password);
                $entreprise->setPassword($password);
                $em->flush();
                $notification = 'Mot de passe changé';
            }
        }
        return $this->render('account/modifications.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }

    /**
     * @Route("/compte/adresse", name="app_adresse")
     */
    public function modifAdresse()
    {
        return $this->render('account/adresse.html.twig');
    }

    /**
     * @Route("/compte/adresse/ajouter-une-adresse", name="app_adresse_add")
     */
    public function add(Cart $cart, Request $req, EntityManagerInterface $em)
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $adresse->setEntreprise($this->getUser());
            $em->persist($adresse);
            $em->flush();
            if ($cart->get()) {
                return $this->redirectToRoute('app_cart');
            }
            return $this->redirectToRoute('app_adresse');
        }
        return $this->render('account/newadresse.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/adresse/modifier{id}", name="app_adresse_upload")
     */
    public function upload(Request $req, $id)
    {
        $adresse = $this->entityManager->getRepository(Adresse::class)->findOneById($id);
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($req);
        if (empty($adresse) || $adresse->getEntreprise() != $this->getUser()) {
            return $this->redirectToRoute('app_adresse');
        }
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('app_adresse');
        }
        return $this->render('account/newadresse.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/adresse/remove{id}", name="app_adresse_remove")
     */
    public function remove($id)
    {
        $adresse = $this->entityManager->getRepository(Adresse::class)->findOneById($id);
        if ($adresse && $adresse->getEntreprise() == $this->getUser()) {
            $this->entityManager->remove($adresse);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse');


    }



}
