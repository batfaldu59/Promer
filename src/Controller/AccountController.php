<?php

namespace App\Controller;

use App\Entity\Entreprise;
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
    /**
     * @Route("/inscription", name="account")
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
        }
        return $this->render('account/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connection", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnection", name="app_logout")
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
}
