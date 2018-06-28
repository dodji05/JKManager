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
     * @Route("/vente")
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

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($form->getData()->getligneVentes() as $ligneVente) {
//                $repository_pr = $doctrine->getRepository('Produit');
//                $code = $ligneVente->getProduit();//()->getId();
//                $produit = $repository_pr->findOneBy(array('id'=> $code));
//                $ligneVente = $ligneVente->setProduit($produit);

                // on recupere le produit concernant la vente
                $majstock = $repository2->findOneBy(array('id'=> $ligneVente->getProduit()) );

                //on effectue le destockage
                $stockactuel = $majstock->getQteEnStock() - $ligneVente->getquantite();

                //on enregistre la nouvelle valeur
                $majstock->setQteEnStock($stockactuel);
                $ligneVente->setVente($vente);

                $em->persist($ligneVente);
                // $em->persist($sortieproduit);
                $em->persist($majstock);


            }
            $vente->setClient($client);
            $em->persist($vente);
            $em->flush();

        }
        return $this->render('ventes/nouvelle_vente.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}