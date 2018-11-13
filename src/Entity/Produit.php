<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @Vich\Uploadable
 */
class Produit
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
    private $Codeproduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleProduit;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixVente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageProduits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitsFournisseurs", mappedBy="Produit")
     */
    private $Fournisseur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailsAppro", mappedBy="Produit")
     */
    private $detailsAppros;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneVentes", mappedBy="Produit")
     */
    private $ligneVentes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StockProduits", mappedBy="Produits")
     */
    private $stock;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="ImageProduits")
     *
     * @var File
     */
    private $imageFile;


    public function __construct()
    {
        $this->Fournisseur = new ArrayCollection();
        $this->detailsAppros = new ArrayCollection();
        $this->ligneVentes = new ArrayCollection();
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCodeproduit(): ?string
    {
        return $this->Codeproduit;
    }

    public function setCodeproduit(string $Codeproduit): self
    {
        $this->Codeproduit = $Codeproduit;

        return $this;
    }

    public function getLibelleProduit(): ?string
    {
        return $this->LibelleProduit;
    }

    public function setLibelleProduit(string $LibelleProduit): self
    {
        $this->LibelleProduit = $LibelleProduit;

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

    public function getImageProduits(): ?string
    {
        return $this->ImageProduits;
    }

    public function setImageProduits(string $ImageProduits): self
    {
        $this->ImageProduits = $ImageProduits;

        return $this;
    }

    /**
     * @return Collection|ProduitsFournisseurs[]
     */
    public function getFournisseur(): Collection
    {
        return $this->Fournisseur;
    }

    public function addFournisseur(ProduitsFournisseurs $fournisseur): self
    {
        if (!$this->Fournisseur->contains($fournisseur)) {
            $this->Fournisseur[] = $fournisseur;
            $fournisseur->setProduit($this);
        }

        return $this;
    }

    public function removeFournisseur(ProduitsFournisseurs $fournisseur): self
    {
        if ($this->Fournisseur->contains($fournisseur)) {
            $this->Fournisseur->removeElement($fournisseur);
            // set the owning side to null (unless already changed)
            if ($fournisseur->getProduit() === $this) {
                $fournisseur->setProduit(null);
            }
        }

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
            $detailsAppro->setProduit($this);
        }

        return $this;
    }

    public function removeDetailsAppro(DetailsAppro $detailsAppro): self
    {
        if ($this->detailsAppros->contains($detailsAppro)) {
            $this->detailsAppros->removeElement($detailsAppro);
            // set the owning side to null (unless already changed)
            if ($detailsAppro->getProduit() === $this) {
                $detailsAppro->setProduit(null);
            }
        }

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
            $ligneVente->setProduit($this);
        }

        return $this;
    }

    public function removeLigneVente(LigneVentes $ligneVente): self
    {
        if ($this->ligneVentes->contains($ligneVente)) {
            $this->ligneVentes->removeElement($ligneVente);
            // set the owning side to null (unless already changed)
            if ($ligneVente->getProduit() === $this) {
                $ligneVente->setProduit(null);
            }
        }

        return $this;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(?File $image = null): void
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            //$this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getStock(): ?StockProduits
    {
        return $this->stock;
    }

    public function setStock(?StockProduits $stock): self
    {
        $this->stock = $stock;

        // set (or unset) the owning side of the relation if necessary
        $newProduits = $stock === null ? null : $this;
        if ($newProduits !== $stock->getProduits()) {
            $stock->setProduits($newProduits);
        }

        return $this;
    }

//    public function setImageName(?string $imageName): void
//    {
//        $this->ImageProduits = $imageName;
//    }
//
//    public function getImageName(): ?string
//    {
//        return $this->ImageProduits;
//    }
}
