<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Offre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //sert a definir la page d'accueil de l'admin, on la change pour la liste des region pour le moment
        //return parent::index(); <-- a la base ca affiche par defaut ca comme admin
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(RegionCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Paca');
    }

    //ajouter des items au menu
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil Dashboard', 'fas fa-home'); 
        yield MenuItem::linkToCrud('Regions', 'fas fa-map-marker-alt', Region::class);
        yield MenuItem::linkToCrud('Offres', 'fas fa-th-list', Offre::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-th-list', Categorie::class);
        yield MenuItem::linkToCrud('Articles', 'fas fa-shopping-bag', Article::class);
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-long-arrow-alt-left', 'carte_accueil');
        //MenuItem::linkToLogout('Deconnexion', 'fa fa-exit'); //lien pour un edeconnexion du site
    }

    //recustomizer l'admin de easyadmin
    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }
}
