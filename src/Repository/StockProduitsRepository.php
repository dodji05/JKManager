<?php

namespace App\Repository;

use App\Entity\StockProduits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StockProduits|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockProduits|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockProduits[]    findAll()
 * @method StockProduits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockProduitsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StockProduits::class);
    }

//    /**
//     * @return StockProduits[] Returns an array of StockProduits objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StockProduits
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
