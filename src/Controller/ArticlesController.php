<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Produit;
use App\Form\SearchType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\compare;

class ArticlesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nosproduits", name="app_produits")
     */
    public function afficheProduit(Request $req) {
        $produits = $this->entityManager->getRepository(Produit::class)->findBy([], ["id" => "DESC"]);
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $produits = $this->entityManager->getRepository(Produit::class)->findWithSearch($search);

        }
        return $this->render("articles/index.html.twig", [
            'products' => $produits,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/nosproduits/{slug}", name="app_show")
     */
    public function show($slug) {
        $leProduit = $this->entityManager->getRepository(Produit::class)->findOneBySlug($slug);
        if (!$leProduit) {
            return $this->redirectToRoute('app_produits');
        }
        return $this->render("articles/show.html.twig", [
            'product' => $leProduit
        ]);
    }
}
