<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockProduitsRepository")
 */
class StockProduits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Produit",inversedBy="stock",cascade={"persist", "remove"})
     */
    private $Produits;

    /**
     * @ORM\Column(type="integer")
     */
    private $QteEnStock;

    public function getId()
    {
        return $this->id;
    }

    public function getProduits(): ?Produit
    {
        return $this->Produits;
    }

    public function setProduits(?Produit $Produits): self
    {
        $this->Produits = $Produits;

        return $this;
    }

    public function getQteEnStock(): ?int
    {
        return $this->QteEnStock;
    }

    public function setQteEnStock(int $QteEnStock): self
    {
        $this->QteEnStock = $QteEnStock;

        return $this;
    }
}
