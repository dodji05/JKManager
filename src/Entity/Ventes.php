<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VentesRepository")
 *
 */
class Ventes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="ventes",cascade={"persist"})
     */
    private $client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateVente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneVentes", mappedBy="Vente")
     *
     */
    private $ligneVentes;

    public function __construct()
    {
        $this->ligneVentes = new ArrayCollection();
        $this->DateVente = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->DateVente;
    }

    public function setDateVente(\DateTimeInterface $DateVente): self
    {
        $this->DateVente = $DateVente;

        return $this;
    }

    /**
     * @return Collection|LigneVentes[]
     */
    public function getLigneVentes(): Collection
    {
        return $this->ligneVentes;
    }

    public function addLigneVente(LigneVentes $ligneVente): self
    {
        if (!$this->ligneVentes->contains($ligneVente)) {
            $this->ligneVentes[] = $ligneVente;
            $ligneVente->setVente($this);
        }

        return $this;
    }

    public function removeLigneVente(LigneVentes $ligneVente): self
    {
        if ($this->ligneVentes->contains($ligneVente)) {
            $this->ligneVentes->removeElement($ligneVente);
            // set the owning side to null (unless already changed)
            if ($ligneVente->getVente() === $this) {
                $ligneVente->setVente(null);
            }
        }

        return $this;
    }
}
