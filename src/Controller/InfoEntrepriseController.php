<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoEntrepriseController extends AbstractController
{
    /**
     * @Route("/notre-entreprise", name="info_entreprise")
     */
    public function index(): Response
    {
        return $this->render('info_entreprise/index.html.twig');
    }
}
