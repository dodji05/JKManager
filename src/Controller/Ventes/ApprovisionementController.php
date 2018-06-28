<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 20/06/2018
 * Time: 12:12
 */

namespace App\Controller\Ventes;


use App\Entity\Approvisionement;
use App\Entity\DetailsAppro;
use App\Entity\StockProduits;
use App\Form\ApprovisionementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/approvision")
 */

class ApprovisionementController extends Controller
{
    /**
     * @Route("/new", name="nvo_appro", methods="GET|POST")
     */
    public function index(Request $request): Response
    {
        //$originalfillieul = new ArrayCollection();

       // $fillieul = new Membres();

        $appro = new Approvisionement();
        $detailsAppro = new DetailsAppro();
        $appro->addDetailsAppro($detailsAppro);
        $stockMagasin = new StockProduits();

        $form = $this->createForm(ApprovisionementType::class, $appro);
        $form->handleRequest($request);

        $doctrine = $this->getDoctrine();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($form->getData()->getDetailsAppros() as $ligneAppro) {

                //On met a jour le stock
                    // On verifie si le produit est deja en magasin
                $stockproduit = $doctrine->getRepository('App:StockProduits')->findOneBy(array('Produits'=>$ligneAppro->getProduit()));


                if($stockproduit === null){
                    // si le produit n'existe pas on creer une nouvelle entre du produit
                    $stockMagasin->setProduits($ligneAppro->getProduit());
                    $stockMagasin->setQteEnStock($ligneAppro->getQuantite());
                    $em->persist($stockMagasin);
                }
                else{
                    // s'il existe on fait une mise de la quantite
                    $nouveaustock =  $stockproduit->getQteEnStock()  + $ligneAppro->getQuantite();
                    $stockproduit->setEnQteStock( $nouveaustock);
                    $em->persist($stockproduit);
                }
                $em->persist($detailsAppro);


            }
            $em->persist($appro);
            $em->flush();
        }

        // return $this->render('clients/index.html.twig', ['clients' => $clientsRepository->findAll()]);
        return $this->render('details_appro/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


}