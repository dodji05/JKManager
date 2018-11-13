<?php

namespace App\Repository;

use App\Entity\DetailsAppro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DetailsAppro|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsAppro|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsAppro[]    findAll()
 * @method DetailsAppro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsApproRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DetailsAppro::class);
    }

//    /**
//     * @return DetailsAppro[] Returns an array of DetailsAppro objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailsAppro
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
