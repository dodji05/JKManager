<?php

namespace App\Repository;

use App\Entity\ProduitsFournisseurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProduitsFournisseurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitsFournisseurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitsFournisseurs[]    findAll()
 * @method ProduitsFournisseurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsFournisseursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProduitsFournisseurs::class);
    }

//    /**
//     * @return ProduitsFournisseurs[] Returns an array of ProduitsFournisseurs objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitsFournisseurs
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function fournisseurDistinct (){
        $qb = $this->createQueryBuilder('f')
     //   ->
            ->distinct()
        ->from('App:ProduitsFournisseurs','P')
            ->orderBy('f.Fournisseur','ASC');
        return $qb->getQuery()->getResult();
    }

    public  function ProduitParFournisseur($telephone){
        $qb = $this->createQueryBuilder('f')
            ->leftJoin('f.Fournisseur', 'four')
            ->leftJoin('f.Produit',' p')
            ->where('four.TelephoneFournisseur = :tel')
            ->setParameter('tel', $telephone)
            ->orderBy('p.LibelleProduit','ASC');
        return $qb->getQuery()->getResult();
    }

}
