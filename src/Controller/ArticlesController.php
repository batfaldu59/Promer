<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\compare;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }

    /**
     * @Route("/nosproduits", name="app_produits")
     */
    public function afficheProduit(ProduitRepository $produitRepository) {
        $produits = $produitRepository->findBy([], ["id" => "DESC"]);
        return $this->render("articles/affichArticle.html.twig", compact("produits"));
    }
}
