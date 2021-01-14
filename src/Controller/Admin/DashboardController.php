<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Entreprise;
use App\Entity\Produit;
use App\Entity\Transporteur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(CommandeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Promer');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Entreprise::class);
        yield MenuItem::linkToCrud('Commmande', 'fas fa-shopping-cart', Commande::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-tags', Produit::class);
        yield MenuItem::linkToCrud('Transporteur', 'fas fa-truck', Transporteur::class);
    }
}
