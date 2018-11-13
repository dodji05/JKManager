<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseursRepository")
 */
class Fournisseurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomFournisseur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PrenomFournisseur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SituationGeographique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TelephoneFournisseur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitsFournisseurs", mappedBy="Fournisseur",cascade={"persist"})
     */
    private $Ligne;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Approvisionement", mappedBy="fournisseur")
     */
    private $appro;

    public function __construct()
    {
        $this->Ligne = new ArrayCollection();
     //   $this->detailsAppros = new ArrayCollection();
        $this->appro = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->NomFournisseur;
    }

    public function setNomFournisseur(string $NomFournisseur): self
    {
        $this->NomFournisseur = $NomFournisseur;

        return $this;
    }

    public function getPrenomFournisseur(): ?string
    {
        return $this->PrenomFournisseur;
    }

    public function setPrenomFournisseur(?string $PrenomFournisseur): self
    {
        $this->PrenomFournisseur = $PrenomFournisseur;

        return $this;
    }

    public function getSituationGeographique(): ?string
    {
        return $this->SituationGeographique;
    }

    public function setSituationGeographique(?string $SituationGeographique): self
    {
        $this->SituationGeographique = $SituationGeographique;

        return $this;
    }

    public function getTelephoneFournisseur(): ?string
    {
        return $this->TelephoneFournisseur;
    }

    public function setTelephoneFournisseur(string $TelephoneFournisseur): self
    {
        $this->TelephoneFournisseur = $TelephoneFournisseur;

        return $this;
    }

    /**
     * @return Collection|ProduitsFournisseurs[]
     */
    public function getLigne(): Collection
    {
        return $this->Ligne;
    }

    public function addLigne(ProduitsFournisseurs $ligne): self
    {
        if (!$this->Ligne->contains($ligne)) {
            $this->Ligne[] = $ligne;
            $ligne->setFournisseur($this);
        }

        return $this;
    }

    public function removeLigne(ProduitsFournisseurs $ligne): self
    {
        if ($this->Ligne->contains($ligne)) {
            $this->Ligne->removeElement($ligne);
            // set the owning side to null (unless already changed)
            if ($ligne->getFournisseur() === $this) {
                $ligne->setFournisseur(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|Approvisionement[]
     */
    public function getAppro(): Collection
    {
        return $this->appro;
    }

    public function addAppro(Approvisionement $appro): self
    {
        if (!$this->appro->contains($appro)) {
            $this->appro[] = $appro;
            $appro->setFournisseur($this);
        }

        return $this;
    }

    public function removeAppro(Approvisionement $appro): self
    {
        if ($this->appro->contains($appro)) {
            $this->appro->removeElement($appro);
            // set the owning side to null (unless already changed)
            if ($appro->getFournisseur() === $this) {
                $appro->setFournisseur(null);
            }
        }

        return $this;
    }
}
