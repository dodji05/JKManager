<?php

namespace App\Repository;

use App\Entity\Ventes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Lu;

/**
 * @method Ventes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ventes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ventes[]    findAll()
 * @method Ventes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VentesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ventes::class);
    }

    public function venteDuJour()
    {
        return $this->createQueryBuilder('v')
            ->andWhere('DATE_DIFF(v.DateVente, CURRENT_DATE()) = DAYOFWEEK')
            ->orderBy('v.DateVente', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function venteSemaineEnCours()
    {
        return $this->createQueryBuilder('v')
            ->andWhere('DATE_DIFF(v.DateVente, CURRENT_DATE()) < (dateOfWeek(CURRENT_DATE()-1))')
            ->orderBy('v.DateVente', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

//    /**
//     * @return Ventes[] Returns an array of Ventes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ventes
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
