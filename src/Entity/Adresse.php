<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "L'intitulé de l'adresse doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "L'intitulé de l'adresse ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le prénom de l'interlocuteur doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le prénom de l'interlocuteur ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le nom de l'interlocuteur doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le nom de l'interlocuteur ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="integer")
     */
    private $numrue;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le nom de rue doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le nom de rue ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complementadresee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom de ville doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le nom de ville ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return $this->getNom()."[br]".$this->getNumrue()." ".$this->getRue()."[br]".$this->getComplementadresee()
            ."[br]".$this->getCodepostal()."[br]".$this->getVille()."-".$this->getPays();
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNumrue(): ?int
    {
        return $this->numrue;
    }

    public function setNumrue(int $numrue): self
    {
        $this->numrue = $numrue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getComplementadresee(): ?string
    {
        return $this->complementadresee;
    }

    public function setComplementadresee(?string $complementadresee): self
    {
        $this->complementadresee = $complementadresee;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
