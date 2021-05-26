<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Region;
use App\Repository\OffreRepository;
use App\Repository\RegionRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="carte_accueil")
     */
    public function index(RegionRepository $regionRepository): Response
    {
        $response = new Response($this->twig->render('carte/index.html.twig', [
            'region' => $regionRepository->findAll(),
        ]));

        $response->setSharedMaxAge(3600);
        return $response;
    }
    
    /**
     * @Route("/region/{slug}", name="region")
     */
    public function showRegion($slug, RegionRepository $regionRepository, OffreRepository $offreRepository): Response
    {
        //par rapport au slug et donc a la region, on obtient les categories
        $offres = $offreRepository->getIdThanksToSlug($slug);
       
        return new Response($this->twig->render('region/show.html.twig', [
            //recupere en fonction du slug envoyé en parametre, les infos de la table region sans boucle
            'regions' => $regionRepository->findOneBy(['slug' => $slug]),
            //obtention des categories de la region
            'offres' => $offres,

        ]));
    }
}
