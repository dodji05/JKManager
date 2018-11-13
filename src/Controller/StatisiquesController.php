<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 09/08/2018
 * Time: 09:17
 */

namespace App\Controller;


use App\Repository\FournisseursRepository;
use App\Repository\LigneVentesRepository;
use App\Repository\ProduitsFournisseursRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ajax Controller
 *
 * @Route("/stats")
 */
class StatisiquesController extends Controller

{
    /**
     * @Route("/ventes/produits", name="stats_produit_vendus", methods="GET")
     */
    public function VentesparProduits(LigneVentesRepository $ligneVentesRepository): Response
    {
        $produitVendus = $ligneVentesRepository->VenteParProduit();
        return $this->render('produit/produit_vendus.html.twig', ['produits' => $produitVendus]);
        //return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/ventes/fournisseurs", name="stats_produit_vendus_fournisseur", methods="GET")
     */
    public function VentesparProduitsFournisseur(LigneVentesRepository $ligneVentesRepository, FournisseursRepository $fournisseursRepository): Response
    {
        $produitVendus = $ligneVentesRepository->VenteParProduitFourniseur();
        $fournisseurs = $fournisseursRepository->fournisseurActive();
    return $this->render('produit/produit_vendus_fournisseur.html.twig', ['produits' => $produitVendus, 'fournisseurs' =>$fournisseurs]);
        //return $this->render('', array('name' => $name));
    }
}