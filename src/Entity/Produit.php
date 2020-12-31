<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ORM\Table(name="Produits")
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $composition;

    /**
     * @ORM\Column(type="text")
     */
    private $modEmploi;

    /**
     * @ORM\Column(type="text")
     */
    private $precautionEmploi;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $conditionnement;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $poidsBrut;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $poidsNet;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbUniteColis;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbUnitePalette;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $densite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pH;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dimensionUniteProduit;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dimensionUniteColis;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dimensionPalette;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageProduit;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomChimique;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixColis;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixPalette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): self
    {
        $this->composition = $composition;

        return $this;
    }

    public function getModEmploi(): ?string
    {
        return $this->modEmploi;
    }

    public function setModEmploi(string $modEmploi): self
    {
        $this->modEmploi = $modEmploi;

        return $this;
    }

    public function getPrecautionEmploi(): ?string
    {
        return $this->precautionEmploi;
    }

    public function setPrecautionEmploi(string $precautionEmploi): self
    {
        $this->precautionEmploi = $precautionEmploi;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getPoidsBrut(): ?string
    {
        return $this->poidsBrut;
    }

    public function setPoidsBrut(string $poidsBrut): self
    {
        $this->poidsBrut = $poidsBrut;

        return $this;
    }

    public function getPoidsNet(): ?string
    {
        return $this->poidsNet;
    }

    public function setPoidsNet(string $poidsNet): self
    {
        $this->poidsNet = $poidsNet;

        return $this;
    }

    public function getNbUniteColis(): ?int
    {
        return $this->nbUniteColis;
    }

    public function setNbUniteColis(int $nbUniteColis): self
    {
        $this->nbUniteColis = $nbUniteColis;

        return $this;
    }

    public function getNbUnitePalette(): ?int
    {
        return $this->nbUnitePalette;
    }

    public function setNbUnitePalette(int $nbUnitePalette): self
    {
        $this->nbUnitePalette = $nbUnitePalette;

        return $this;
    }

    public function getDensite(): ?string
    {
        return $this->densite;
    }

    public function setDensite(string $densite): self
    {
        $this->densite = $densite;

        return $this;
    }

    public function getPH(): ?string
    {
        return $this->pH;
    }

    public function setPH(string $pH): self
    {
        $this->pH = $pH;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getDimensionUniteProduit(): ?string
    {
        return $this->dimensionUniteProduit;
    }

    public function setDimensionUniteProduit(string $dimensionUniteProduit): self
    {
        $this->dimensionUniteProduit = $dimensionUniteProduit;

        return $this;
    }

    public function getDimensionUniteColis(): ?string
    {
        return $this->dimensionUniteColis;
    }

    public function setDimensionUniteColis(string $dimensionUniteColis): self
    {
        $this->dimensionUniteColis = $dimensionUniteColis;

        return $this;
    }

    public function getDimensionPalette(): ?string
    {
        return $this->dimensionPalette;
    }

    public function setDimensionPalette(string $dimensionPalette): self
    {
        $this->dimensionPalette = $dimensionPalette;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getImageProduit(): ?string
    {
        return $this->imageProduit;
    }

    public function setImageProduit(string $imageProduit): self
    {
        $this->imageProduit = $imageProduit;

        return $this;
    }

    public function getNomChimique(): ?string
    {
        return $this->nomChimique;
    }

    public function setNomChimique(string $nomChimique): self
    {
        $this->nomChimique = $nomChimique;

        return $this;
    }

    public function getPrixColis(): ?int
    {
        return $this->prixColis;
    }

    public function setPrixColis(int $prixColis): self
    {
        $this->prixColis = $prixColis;

        return $this;
    }

    public function getPrixPalette(): ?int
    {
        return $this->prixPalette;
    }

    public function setPrixPalette(int $prixPalette): self
    {
        $this->prixPalette = $prixPalette;

        return $this;
    }
}
