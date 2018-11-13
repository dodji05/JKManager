<?php

namespace App\Repository;

use App\Entity\LigneVentes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LigneVentes|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneVentes|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneVentes[]    findAll()
 * @method LigneVentes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneVentesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LigneVentes::class);
    }

//    /**
//     * @return LigneVentes[] Returns an array of LigneVentes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LigneVentes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    function VenteParProduit(){
        $qb = $this->createQueryBuilder('l')
            ->select('SUM (l.Quantite) as total, p.LibelleProduit, p.Codeproduit')
            // ->addSelect('l.produit')
            ->leftJoin('l.Vente','v')
            ->leftJoin('l.Produit','p')
            //->where('s.id = :section')
          //  ->andWhere('DATE_DIFF(v.dateVente, CURRENT_DATE()) = 0')
           // ->setParameter('section',$section)
            ->groupBy('l.Produit')
            // ->addGroupBy('')

            ->orderBy('p.LibelleProduit','ASC');
        return $qb->getQuery()->getResult();

    }

    function VenteParProduitFourniseur(){
        $qb = $this->createQueryBuilder('l')
           ->select('SUM (l.Quantite) as total , p.LibelleProduit, p.PrixVente, p.id as produit_id, fr.id')
          // ->addSelect('p.Fournisseur')
           //  ->addSelect('l.Produit')
            ->leftJoin('l.Vente','v')
            ->leftJoin('l.Produit','p')
            ->leftJoin('p.Fournisseur','F')
            ->leftJoin('F.Fournisseur','fr')
        //->leftJoin('p.Fournisseur','fr')
            //->where('s.id = :section')
            //  ->andWhere('DATE_DIFF(v.dateVente, CURRENT_DATE()) = 0')
            // ->setParameter('section',$section)
            ->groupBy('l.Produit')
             ->addGroupBy('fr.id')

            ->orderBy('p.id','ASC');
        return $qb->getQuery()->getResult();

    }
    function VenteParProduitFourniseurID(){
        $qb = $this->createQueryBuilder('l')
          //  ->select('')
            ->select('fr.id')
            // ->addSelect('l.produit')
            ->leftJoin('l.Vente','v')
            ->leftJoin('l.Produit','p')
            ->leftJoin('p.Fournisseur','F')
            ->leftJoin('F.Fournisseur','fr')
            //  ->leftJoin('p.Fournisseur','fr')
            //->where('s.id = :section')
            //  ->andWhere('DATE_DIFF(v.dateVente, CURRENT_DATE()) = 0')
            // ->setParameter('section',$section)
            ->groupBy('fr.id');
            // ->addGroupBy('')

           // ->orderBy('p.LibelleProduit','ASC');
        ;
        return $qb->getQuery()->getResult();

    }


}
