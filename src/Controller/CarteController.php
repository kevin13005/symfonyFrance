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
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

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
        //mise en cache avec le systeme par defaut de symfony sans configurer cache.yml
        $cache = new FilesystemAdapter();
        //use est utilisé car $regionrepository est injecté comme une variable globale de la fontion principale
        //dans cette fonction ci dessous qui est secondaire, si on fait pas ca , ca marche pas
        $valeurStocker = $cache->get('my_cache_key', function (ItemInterface $item)use($regionRepository) {
            $item->expiresAfter(10);

            $requeteregion = $regionRepository->findAll();
            return $requeteregion;
        });

        return new Response($this->twig->render('carte/index.html.twig', [
            'region' => $valeurStocker,
        ]));
        
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
