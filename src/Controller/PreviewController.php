<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 16/11/2018
 * Time: 16:46
 */

namespace App\Controller;

use App\Entity\Ventes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/preview")
 */
class PreviewController extends Controller
{
    /**
     * @Route("/client/facture/{id}/preview", name="client_facture_preview",options={"expose"=true})
     */
    function factureClientPreview(Ventes $vente) : Response
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('App:Ventes');

        $ventes = $repository->findOneBy(array(
            'id'=>$vente
        ));





        return $this->render('ventes/facture_details.html.twig', array(
            'vente' => $vente,
            // 'secton' => $section_id
        ));

    }
}