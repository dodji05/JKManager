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
       $appro =  new Approvisionement();
       $ligne = new DetailsAppro();
       $ligne->setFournisseur($appro);
       $appro->getDetailsAppros()->add($ligne);

       $form = $this->createForm(ApprovisionementType::class, $appro);
       $form->handleRequest($request);

        // return $this->render('clients/index.html.twig', ['clients' => $clientsRepository->findAll()]);
        return $this->render('details_appro/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


}