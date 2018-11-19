<?php

namespace App\Controller;

use App\Entity\Approvisionement;
use App\Entity\DetailsAppro;
use App\Entity\Fournisseurs;
use App\Entity\StockProduits;
use App\Form\ApprovisionementType;
use App\Form\DetailsApproType;
use App\Form\FournisseursType;
use App\Repository\DetailsApproRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/approvisionnement")
 */
class DetailsApproController extends Controller
{
    /**
     * @Route("/", name="details_appro_index", methods="GET")
     */
    public function index(DetailsApproRepository $detailsApproRepository): Response
    {
        return $this->render('details_appro/index.html.twig', ['details_appros' => $detailsApproRepository->findAll()]);
    }

    /**
     * @Route("/new", name="details_appro_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $doctrine = $this->getDoctrine();
        $appro = new Approvisionement();

        $detailsAppro = new DetailsAppro();
        // $tag1->name = 'tag1';
        $appro->addDetailsAppro($detailsAppro );

        $fournisseur = new Fournisseurs();


//        $appro = new Approvisionement();
//
//        $appro->addDetailsAppro($detailsAppro);
//      //  $detailsAppro->setApprovision($appro);
      $stockMagasin = new StockProduits();


        $form = $this->createForm(ApprovisionementType::class, $appro)
        ->add('fournisseur', FournisseursType::class, array('data' => $fournisseur, 'mapped' => false,));

        $form->handleRequest($request);
        $doctrine = $this->getDoctrine();
        $repfournisseur = $doctrine->getRepository('App:Fournisseurs');
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//
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
                    $stockproduit->setQteEnStock($nouveaustock);
                    $em->persist($stockproduit);
                }
            $ligneAppro->setApprovision($appro);
                $em->persist($ligneAppro);
            }
            $telclient = $request->get('approvisionement')['fournisseur']["TelephoneFournisseur"];

            // on verifie si le client existe deja dans la base de donnnee
            $fournisseurdeja = $repfournisseur->findOneBy(array('TelephoneFournisseur'=>$telclient) );

            if(!$fournisseurdeja){
                // il n existe pas , nous le sauvergadons dans la base
                $appro->setFournisseur($fournisseur);
                $em->persist($appro);
                $em->flush();
            }
            else {
                $appro->setFournisseur($fournisseurdeja);
                $em->persist($appro);
                $em->detach($fournisseur);
                $em->flush();
            }


            return $this->redirectToRoute('resume_appro', ['id' => $appro->getId()]);
        }
        else {
//            dump($form->getErrors(true));
//            die();
        }

        return $this->render('details_appro/new.html.twig', [
            'details_appro' => $detailsAppro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nouveau/{id}/fournisseur", name="appro_nouveau", methods="GET|POST")
     */
    public function nouveau(Request $request, Fournisseurs $fournisseur): Response
    {
        $doctrine = $this->getDoctrine();
        $appro = new Approvisionement();

        $detailsAppro = new DetailsAppro();
        // $tag1->name = 'tag1';
        $appro->addDetailsAppro($detailsAppro );


        $stockMagasin = new StockProduits();
        $form = $this->createForm(ApprovisionementType::class, $appro)
           ->add('fournisseur', FournisseursType::class, array('data' => $fournisseur, 'mapped' => false,));
//
        $form->handleRequest($request);
        $doctrine = $this->getDoctrine();
        $repfournisseur = $doctrine->getRepository('App:Fournisseurs');
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//
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
                    $stockproduit->setQteEnStock($nouveaustock);
                    $em->persist($stockproduit);
                }
                $ligneAppro->setApprovision($appro);
                $em->persist($ligneAppro);
            }
           // $telclient = $request->get('approvisionement')['fournisseur']["TelephoneFournisseur"];

            // on verifie si le client existe deja dans la base de donnnee
           // $fournisseurdeja = $repfournisseur->findOneBy(array('TelephoneFournisseur'=>$telclient) );


                $appro->setFournisseur($fournisseur);
                $em->persist($appro);
                $em->detach($fournisseur);
                $em->flush();



            return $this->redirectToRoute('resume_appro', ['id' => $appro->getId()]);
        }
        else {
//            dump($form->getErrors(true));
//            die();
        }

        return $this->render('details_appro/new.html.twig', [
            'details_appro' => $detailsAppro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="details_appro_show", methods="GET")
     */
//    public function show(DetailsAppro $detailsAppro): Response
//    {
//        return $this->render('details_appro/show.html.twig', ['details_appro' => $detailsAppro]);
//    }

    /**
     * @Route("/{id}/edit", name="details_appro_edit", methods="GET|POST")
     */
    public function edit(Request $request, DetailsAppro $detailsAppro): Response
    {
        $form = $this->createForm(DetailsApproType::class, $detailsAppro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('details_appro_edit', ['id' => $detailsAppro->getId()]);
        }

        return $this->render('details_appro/edit.html.twig', [
            'details_appro' => $detailsAppro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="details_appro_delete", methods="DELETE")
     */
    public function delete(Request $request, DetailsAppro $detailsAppro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailsAppro->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($detailsAppro);
            $em->flush();
        }

        return $this->redirectToRoute('details_appro_index');
    }
    /**
     * @Route("/new/new", name="details_appro_next", methods="GET|POST")
     */
    public function liste (Request $request){
        $appro = new DetailsAppro();
        $form = $this->createForm(DetailsApproType::class, $appro);
        $form->handleRequest($request);
        return $this->render('details_appro/new_new.html.twig', [
            //'details_appro' => $detailsAppro,
            'form' => $form->createView(),
        ]);

    }
    /**
     * @Route("/details/{id}", name="resume_appro", methods="GET|POST")
     */
    public function recapAppro(Approvisionement $Appro){
        return $this->render('details_appro/details_appro.html.twig', ['details_appro' => $Appro]);

    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @Route("/get-neighborhoods-from-city", name="person_list_neighborhoods", methods="GET|POST")

     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listNeighborhoodsOfCityAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $neighborhoodsRepository = $em->getRepository("App:Fournisseurs");

        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"
        $neighborhoods = $neighborhoodsRepository->createQueryBuilder("q")
            ->leftJoin("q.Ligne", "l")
            ->where("l.Produit = :cityid")
            ->setParameter("cityid", $request->query->get("cityid"))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($neighborhoods as $neighborhood){
            $responseArray[] = array(
                "id" => $neighborhood->getId(),
                "name" => $neighborhood->getName()
            );
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }
}
