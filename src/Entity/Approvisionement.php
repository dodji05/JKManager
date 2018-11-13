<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApprovisionementRepository")
 */
class Approvisionement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateAppro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailsAppro", mappedBy="Approvision")
     */
    private $detailsAppros;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseurs", inversedBy="appro",cascade={"persist"})
     */
    private $fournisseur;


    public function __construct()
    {
        $this->detailsAppros = new ArrayCollection();
        $this->DateAppro = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateAppro(): ?\DateTimeInterface
    {
        return $this->DateAppro;
    }

    public function setDateAppro(\DateTimeInterface $DateAppro): self
    {
        $this->DateAppro = $DateAppro;

        return $this;
    }

    /**
     * @return Collection|DetailsAppro[]
     */
    public function getDetailsAppros(): Collection
    {
        return $this->detailsAppros;
    }

    public function addDetailsAppro(DetailsAppro $detailsAppro): self
    {
        if (!$this->detailsAppros->contains($detailsAppro)) {
            $this->detailsAppros[] = $detailsAppro;
            $detailsAppro->setApprovision($this);
        }

        return $this;
    }

    public function removeDetailsAppro(DetailsAppro $detailsAppro): self
    {
        if ($this->detailsAppros->contains($detailsAppro)) {
            $this->detailsAppros->removeElement($detailsAppro);
            // set the owning side to null (unless already changed)
            if ($detailsAppro->getApprovision() === $this) {
                $detailsAppro->setApprovision(null);
            }
        }

        return $this;
    }

    public function getFournisseur(): ?Fournisseurs
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseurs $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

}
