<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function getArticleFirstCategorieDeLoffre($titre, ArticleSearch $filtre){
        $query = $this->createQueryBuilder('a');

        $query
            ->select('a.titre, a.contenu, a.image, a.price')
            ->join('a.categorie', 'c')
            ->where('c.titre = :titre')
            ->setParameter('titre', $titre);

            if($filtre->getMinPrice()){
                $query = $query
                    ->andWhere('a.price >= :minPrice')
                    ->setParameter('minPrice', $filtre->getMinPrice());

            }
            if($filtre->getMaxPrice()){
                $query = $query
                    ->andWhere('a.price <= :maxPrice')
                    ->setParameter('maxPrice', $filtre->getMaxPrice());

            }

        $resultat = $query->getQuery();
        return $resultat->getResult();

        
    }

    public function getArticleCategorieDeLoffre($id, ArticleSearch $filtre){
        $query = $this->createQueryBuilder('a');

        $query
            ->select('a.titre, a.contenu, a.image, a.price')
            ->join('a.categorie', 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id);

            if($filtre->getMinPrice()){
                $query = $query
                    ->andWhere('a.price >= :minPrice')
                    ->setParameter('minPrice', $filtre->getMinPrice());

            }
            if($filtre->getMaxPrice()){
                $query = $query
                    ->andWhere('a.price <= :maxPrice')
                    ->setParameter('maxPrice', $filtre->getMaxPrice());

            }

        $resultat = $query->getQuery();
        return $resultat->getResult();

        
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
