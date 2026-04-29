<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    // DQL
//    public function findContainsSubstring(String $substring) {
//        $entityManager = $this->getEntityManager();
//        // SELECT id, title, releaseDate FROM movies WHERE title LIKE '%tr%';
//        $dql = "
//            SELECT m FROM App\Entity\Movie m
//            WHERE m.title LIKE :substring
//        ";
//        $query = $entityManager->createQuery($dql);
//        $query->setParameter('substring', '%'.$substring.'%');
//
//        return $query->getResult();
//    }

    // QueryBuilder
    public function findContainsSubstring(String $substring) {
        $entityManager = $this->getEntityManager();
        // SELECT id, title, releaseDate FROM movies WHERE title LIKE '%tr%';
        $queryBuilder = $this->createQueryBuilder('movie');
        $queryBuilder->andWhere('movie.title LIKE :substring');
        $queryBuilder->setParameter('substring', '%'.$substring.'%');
        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    //    /**
    //     * @return Movie[] Returns an array of Movie objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Movie
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
