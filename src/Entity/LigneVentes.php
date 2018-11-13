<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneVentesRepository")
 */
class LigneVentes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="ligneVentes")
     */
    private $Produit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ventes", inversedBy="ligneVentes")
     */
    private $Vente;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixVente;

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

    public function getVente(): ?Ventes
    {
        return $this->Vente;
    }

    public function setVente(?Ventes $Vente): self
    {
        $this->Vente = $Vente;

        return $this;
    }

    public function getPrixVente(): ?int
    {
        return $this->PrixVente;
    }

    public function setPrixVente(int $PrixVente): self
    {
        $this->PrixVente = $PrixVente;

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
