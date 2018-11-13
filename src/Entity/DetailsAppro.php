<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailsApproRepository")
 */
class DetailsAppro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="detailsAppros")
     */
    private $Produit;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Approvisionement", inversedBy="detailsAppros")
     */
    private $Approvision;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixAppro;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantite;

    /**
     * @var int
     */
    private $total;

    public function getId()
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }



    public function getApprovision(): ?Approvisionement
    {
        return $this->Approvision;
    }

    public function setApprovision(?Approvisionement $Approvision): self
    {
        $this->Approvision = $Approvision;

        return $this;
    }

    public function getPrixAppro(): ?int
    {
        return $this->PrixAppro;
    }

    public function setPrixAppro(int $PrixAppro): self
    {
        $this->PrixAppro = $PrixAppro;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

}
