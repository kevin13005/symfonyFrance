<?php

namespace App\Controller;

use App\Entity\Offre;
use Twig\Environment;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CategorieController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/categorie/{id}", name="categorie")
     */
    public function index($id, CategorieRepository $categorieRepository, Offre $offre, ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //on recupere les categories qui font partie de l'offre sur laquelle on a cliqué
        $catOffre = $categorieRepository->getCategorieEnFonctionIDoffre($id);
        
        //pour l'affichage de la page d'accueil, avant filtrage, on recupere les resultats de la 1ere categorie
        //par defaut pour qu'il y ait un affichage quand même
        $titre = $catOffre[0]['titre'];

        //on recupere les articles de la 1ere categorie en fonction de l'argument titre, nous on choisit
        //pour l'affichage par defaut de la page d'afficher les articles de la 1ere categorie
        $articles = $articleRepository->getArticleFirstCategorieDeLoffre($titre);

        //on fait la pagination avec le bundle
        $pagination = $paginator->paginate(
            $articles, /* la requete */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return new response( $this->twig->render('categorie/index.html.twig', [
            'categorieDansOffres' => $catOffre,
            'articles' => $pagination,
            'idatransmettre'=>$id,
        ]));
    }

    /**
     * @Route("/cat/{id1}/{idoffre}", name="article")
     */
    public function categorieList($id1, $idoffre, CategorieRepository $categorieRepository, ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //on recupere les categories qui font partie de l'offre sur laquelle on a cliqué
        $catOffre = $categorieRepository->getCategorieEnFonctionIDoffre($idoffre);

        //on recupere les articles en fonction de la categorie sur laquelle on a cliqué
        $articles = $articleRepository->getArticleCategorieDeLoffre($id1);
        
        //la pagination
        $pagination = $paginator->paginate(
            $articles, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return new response( $this->twig->render('categorie/article.html.twig', [
            'categorieDansOffres' => $catOffre,
            'articles' => $pagination,
            'idatransmettre'=>$idoffre,
        ]));
    }
}
