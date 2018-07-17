<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 26/06/2018
 * Time: 12:28
 */

namespace App\Controller\Ventes;


use App\Repository\StockProduitsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StockController extends Controller
{
    /**
     * @Route("/stocksu", name="stock_produit")
     */
    public function produitStock(StockProduitsRepository $stockRepository): Response
    {
        return $this->render('produit/stock_produits.html.twig', ['produits' => $stockRepository->findAll()]);

    }
}