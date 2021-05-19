<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Repository\ArticleRepository;
use Twig\Environment;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/categorie")
*/
class CategorieController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    
    /**
     * @Route("/{id}", name="categorie")
     */
    public function index($id, CategorieRepository $categorieRepository, Offre $offre, ArticleRepository $articleRepository): Response
    {
        //on recupere les categories qui font partie de l'offre sur laquelle on a cliqué
        $catOffre = $categorieRepository->getCategorieEnFonctionIDoffre($id);

        //pour l'affichage de la page d'accueil, avant filtrage, on recupere les resultats de la 1ere categorie
        //par defaut pour qu'il y ait un affichage quand même
        $titre = $catOffre[0]['titre'];

        //on recupere les articles de la 1ere categorie en fonction de l'argument titre
        $articles = $articleRepository->getArticleFirstCategorieDeLoffre($titre);
        
        return new response( $this->twig->render('categorie/index.html.twig', [
            'categorieDansOffres' => $catOffre,
            'articles' => $articles,
        ]));
    }
}
