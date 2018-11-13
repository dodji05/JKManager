<?php

namespace App\Controller;

use App\Entity\Fournisseurs;
use App\Entity\ProduitsFournisseurs;
use App\Form\FournisseursPrixType;
use App\Form\FournisseursType;
use App\Form\PrixFournisseursType;
use App\Form\ProduitsFournisseursType;
use App\Repository\ProduitsFournisseursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produits/fournisseurs")
 */
class ProduitsFournisseursController extends Controller
{
    /**
     * @Route("/", name="produits_fournisseurs_index", methods="GET")
     */
    public function index(ProduitsFournisseursRepository $produitsFournisseursRepository): Response
    {
        return $this->render('produits_fournisseurs/index.html.twig', ['produits_fournisseurs' => $produitsFournisseursRepository->findAll()]);
    }

    /**
     * @Route("/new", name="produits_fournisseurs_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

//        $fournisseur = new Fournisseurs();
//        $prixfournisseur = new ProduitsFournisseurs();
//        $prixfournisseur->setFournisseur($fournisseur);
//        $fournisseur->addLigne($prixfournisseur);
//        $form = $this->createForm(FournisseursPrixType::class, $fournisseur);

        $prixfournisseur= new ProduitsFournisseurs();
        $fournisseur = new Fournisseurs();
        $form = $this->createForm(PrixFournisseursType::class, $prixfournisseur)
        ->add('Fournisseur', FournisseursType::class, array('data' => $fournisseur, 'mapped' => false,));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

           foreach ($form->getData()->geProduit() as $ligne){
            //   $em->persist($ligne);
               //$prixfournisseur->setFournisseur($ligne->getFournisseur());
              $ligne->setFournisseur($fournisseur);
              $em->persist($ligne);
             //  $em->persist( $ligne);
           }

            $repository = $em->getRepository('App:Fournisseurs');

            $fournisseurok =  $repository->findOneBy(array('TelephoneFournisseur'=>$form->getData()->getTelephoneFournisseur()));
            dump($fournisseurok);

            die();
            if(!$fournisseurok){
                $em->persist($fournisseur);
               $em->flush();
            }
           else {
               $em->detach($fournisseur);
            $em->detach($fournisseurok);
                $em->flush();
            }


            return $this->redirectToRoute('produits_fournisseurs_index');
        }

        return $this->render('produits_fournisseurs/new.html.twig', [
           // 'produits_fournisseur' => $produitsFournisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_fournisseurs_show", methods="GET")
     */
    public function show(ProduitsFournisseurs $produitsFournisseur): Response
    {
        return $this->render('produits_fournisseurs/show.html.twig', ['produits_fournisseur' => $produitsFournisseur]);
    }

    /**
     * @Route("/{id}/edit", name="produits_fournisseurs_edit", methods="GET|POST")
     */
    public function edit(Request $request, ProduitsFournisseurs $produitsFournisseur): Response
    {
        $form = $this->createForm(ProduitsFournisseursType::class, $produitsFournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_fournisseurs_edit', ['id' => $produitsFournisseur->getId()]);
        }

        return $this->render('produits_fournisseurs/edit.html.twig', [
            'produits_fournisseur' => $produitsFournisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_fournisseurs_delete", methods="DELETE")
     */
    public function delete(Request $request, ProduitsFournisseurs $produitsFournisseur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitsFournisseur->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produitsFournisseur);
            $em->flush();
        }

        return $this->redirectToRoute('produits_fournisseurs_index');
    }
}
