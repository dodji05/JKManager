<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 22/06/2018
 * Time: 08:37
 */

namespace App\Controller\Ventes;


use App\Entity\Clients;
use App\Entity\LigneVentes;
use App\Entity\Ventes;
use App\Form\ClientsType;
use App\Form\VentesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VenteController extends Controller
{
    /**
     * @Route("/vente", name="vente")
     */
    function Vente(Request $request){
        $doctrine = $this->getDoctrine();
        $vente = new Ventes();

        $ligne = new LigneVentes();
        // $tag1->name = 'tag1';
    $vente->addLigneVente($ligne);
        $client = new Clients();
        $form = $this->createForm(VentesType::class, $vente)

            ->add('client', ClientsType::class, array('data' => $client, 'mapped' => false,));
        $form->handleRequest($request);

        // On recupere les informations sur le stock du produit
        $repository2 = $doctrine->getRepository('App:StockProduits');
        $repclients = $doctrine->getRepository('App:Clients');

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($form->getData()->getligneVentes() as $ligneVente) {
//
                // on recupere le produit concernant la vente
                $majstock = $repository2->findOneBy(array('Produits'=> $ligneVente->getProduit()) );

                //on effectue le destockage
                $stockactuel = $majstock->getQteEnStock() - $ligneVente->getQuantite();

                //on enregistre la nouvelle valeur
                $majstock->setQteEnStock($stockactuel);
                $ligneVente->setVente($vente);

                $em->persist($ligneVente);
                // $em->persist($sortieproduit);
                $em->persist($majstock);


            }
        $telclient = $request->get('ventes')['client']["Telephone1"];
            // on verifie si le client existe deja dans la base de donnnee
            $clientdeja = $repclients->findOneBy(array('Telephone1'=>$telclient) );
            if(!$clientdeja){
                // il n existe pas , nous le sauvergadons dans la base
                $vente->setClient($client);
                $em->persist($vente);
                $em->flush();
            }
            else {
                $vente->setClient($clientdeja);
                $em->persist($vente);
                $em->detach($client);
                $em->flush();
            }

            $this->addFlash('notice','La vente a été enregistrée avec sucess ');
            return $this->redirectToRoute('facture',array('id_vente'=>$vente->getId()));

        }
        return $this->render('ventes/nouvelle_vente.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/vente/facture/{id_vente}",name="facture")
     */
    function Facture (Request $request,$id_vente){
        $doctrine = $this->getDoctrine();

        //on recupere la vente
        $repository1 = $doctrine->getRepository('App:Ventes');
        $vente = $repository1->findOneBy(array('id' => $id_vente,));
        return $this->render('ventes/facture_vente.html.twig', array(

            'vente' => $vente
        ));
    }

    /**
     * @Route("/ventes",name="toute_vente")
     */
    function TousLesVentes (){
        $doctrine = $this->getDoctrine();

        //on recupere la vente
        $repository1 = $doctrine->getRepository('App:Ventes');
        $ventes = $repository1->findAll();
        return $this->render('ventes/Liste_ventes.html.twig', array(

            'ventes' => $ventes
        ));
    }

    /**
     * @Route("/ventes/ventes_du_jour",name="vente_jour")
     */
    function ventesDuJour (){
        $doctrine = $this->getDoctrine();

        //on recupere la vente
        $repository1 = $doctrine->getRepository('App:Ventes');
        $ventes = $repository1->venteDuJour();
        return $this->render('ventes/Liste_ventes.html.twig', array(
            'type'=>'venteJour',
            'ventes' => $ventes
        ));
    }

    /**
     * @Route("/ventes/semaine",name="vente_semaine")
     */
    function ventesDeLaSemaine (){
        $doctrine = $this->getDoctrine();

        //on recupere la vente
        $repository1 = $doctrine->getRepository('App:Ventes');
        $ventes = $repository1->venteSemaineEnCours();
        return $this->render('ventes/Liste_ventes.html.twig', array(
            'type'=>'venteJour',
            'ventes' => $ventes
        ));
    }

}