<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 31/05/2018
 * Time: 13:00
 */

namespace App\Controller\Ventes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableauBordController extends Controller
{
    /**
     * @Route("/")
     */
    function Accueil(){
        $doctrine = $this->getDoctrine();
        $clients = $doctrine->getRepository('App:Clients')->findAll();
        $fournisseur = $doctrine->getRepository('App:Fournisseurs')->findAll();
        $vente = $doctrine->getRepository('App:Ventes')->findAll();
        $produit = $doctrine->getRepository('App:Produit')->findAll();

        $nbClients = count($clients);
        $nbfournisseur = count($fournisseur);
        $nbVentes = count($vente);
        $nbProduit = count($produit);

        return $this->render('tb/index.html.twig',
            [
                'nbClients' => $nbClients,
                'nbfournisseur' => $nbfournisseur,
                'nbVentes' => $nbVentes,
                'nbProduit' => $nbProduit,
            ]);
    }
}