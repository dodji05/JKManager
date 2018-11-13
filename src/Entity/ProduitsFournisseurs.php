<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsFournisseursRepository")
 */
class ProduitsFournisseurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="Fournisseur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Produit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseurs", inversedBy="Ligne",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Fournisseur;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

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

    public function getFournisseur(): ?Fournisseurs
    {
        return $this->Fournisseur;
    }

    public function setFournisseur(?Fournisseurs $Fournisseur): self
    {
        $this->Fournisseur = $Fournisseur;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }
}
