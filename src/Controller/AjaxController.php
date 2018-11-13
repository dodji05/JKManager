<?php
/**
 * Created by PhpStorm.
 * User: gildas
 * Date: 6/30/18
 * Time: 10:47 PM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ajax Controller
 *
 * @Route("ajax")
 */
class AjaxController extends Controller
{
    /**
     * @Route("/fournisseur/{tel}",name="fournisseur_auto",options={"expose"=true})
     */
    function fournisseurNum($tel) {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('App:Fournisseurs');

        $fournisseur =  $repository->findOneBy(array('TelephoneFournisseur'=>$tel));
//        var_dump($fournisseur);
        ///die();
        if($fournisseur)
        {$response = array("success" => true,
            // "code"=>$code,
            'Nom'=>$fournisseur->getNomFournisseur(),
            'Prenom'=>$fournisseur->getPrenomFournisseur(),
            'SituationGeo'=>$fournisseur->getSituationGeographique(),
           // ''=>$fournisseur[0]['r_bV']
        );}
        else {$response = array("success" => false,
        );}


        return new Response(json_encode($response));
    }
    /**
     * @Route("/produit/{id}",name="produit_ajax",options={"expose"=true})
     */
    function ProduitsNum($id) {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('App:Produit');

        $produit =  $repository->findOneBy(array('id'=>$id));
//        var_dump($produit);
        ///die();
        if($produit)
        {$response = array("success" => true,
            // "code"=>$code,
            'prix'=>$produit->getPrixVente(),
            'stock'=>$produit->getStock()->getQteEnStock()
//            'Prenom'=>$produit->getPrenomFournisseur(),
//            'SituationGeo'=>$produit->getSituationGeographique(),
            // ''=>$produit[0]['r_bV']
        );}
        else {$response = array("success" => false,
        );}


        return new Response(json_encode($response));
    }

    /**
     * @Route("/client/recherche/{telephone}",name="client_recherche_ajax",options={"expose"=true})
     */
    function ClientParTel($telephone) {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('App:Clients');

        $client =  $repository->findOneBy(array('Telephone1'=>$telephone));
//        var_dump($produit);
        ///die();
        if($client)
        {$response = array("success" => true,
            // "code"=>$code,
            'Nom'=>$client->getNomClient(),
            'Prenom'=>$client->getPrenomClient(),
            'Tel1'=>$client->getTelephone1(),
            'Tel2'=>$client->getTelephone2(),
            'Zone'=>$client->getZoneGeographique(),
            'Lieu'=>$client->getLieuxLivraison(),
            'Sexe'=>$client->getSexe(),
//            'Prenom'=>$produit->getPrenomFournisseur(),
//            'SituationGeo'=>$produit->getSituationGeographique(),
            // ''=>$produit[0]['r_bV']
        );}
        else {$response = array("success" => false,
        );}


        return new Response(json_encode($response));
    }

    /**
     * @Route("/fournisseurs/recherche/{telephone}",name="fournisseur_recherche_ajax",options={"expose"=true})
     */
    function FournisseurParTel($telephone) {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('App:Fournisseurs');

        $fournisseur=  $repository->findOneBy(array('TelephoneFournisseur'=>$telephone));
//        var_dump($produit);
        ///die();
        if($fournisseur)
        {$response = array("success" => true,
            // "code"=>$code,
            'Nom'=>$fournisseur->getNomFournisseur(),
            'Prenom'=>$fournisseur->getPrenomFournisseur(),
            'Tel1'=>$fournisseur->getTelephoneFournisseur(),
//            'Tel2'=>$fournisseur->getTelephone2(),
            'Zone'=>$fournisseur->getSituationGeographique(),


//            'Prenom'=>$produit->getPrenomFournisseur(),
//            'SituationGeo'=>$produit->getSituationGeographique(),
            // ''=>$produit[0]['r_bV']
        );}
        else {$response = array("success" => false,
        );}


        return new Response(json_encode($response));
    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @Route("/get-neighborhoods-from-city",name="person_list_neighborhoods",options={"expose"=true})
     * @param Request $request
     * @return JsonResponse
     */
    public function listNeighborhoodsOfCityAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $neighborhoodsRepository = $em->getRepository("App:ProduitsFournisseurs");

        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"
        $neighborhoods = $neighborhoodsRepository->createQueryBuilder("q")
            ->where("q.Produit = :cityid")
            ->setParameter("cityid", $request->query->get("Produit"))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($neighborhoods as $neighborhood){
            $responseArray[] = array(
                "id" => $neighborhood->getFournisseur()->getId(),
                "name" => $neighborhood->getFournisseur()->getNomFournisseur()
            );
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }
}