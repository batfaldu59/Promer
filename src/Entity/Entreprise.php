<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 180,
     *      minMessage = "Le mail doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le mail ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Le nom doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le nom ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=14, unique=true)
     * @Assert\Length(
     *      min = 14,
     *      max = 14,
     *      exactMessage = "Un numéro de siret comporte {{ limit }} caractères."
     * )
     */
    private $numsiret;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      exactMessage = "Le code du statut juridique comporte {{ limit }} caractères."
     * )
     */
    private $statutjuridique;

    /**
     * @ORM\Column(type="string", length=8, unique=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      exactMessage = "Un code APE comporte {{ limit }} caractères."
     * )
     */
    private $codeAPE;

    /**
     * @ORM\Column(type="integer")
     */
    private $numVoie;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de rue doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le nom de rue ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $complementadresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(
     *      min = 1,
     *      max = 25,
     *      minMessage = "Le nom de ville doit faire au moins {{ limit }} caractères.",
     *      maxMessage = "Le nom de ville ne doit pas faire plus de {{ limit }} caractères."
     * )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Representant::class, mappedBy="entreprise")
     */
    private $representants;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="entreprise")
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="entreprise")
     */
    private $commandes;

    public function __construct()
    {
        $this->representants = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getNumsiret(): ?string
    {
        return $this->numsiret;
    }

    public function setNumsiret(string $numsiret): self
    {
        $this->numsiret = $numsiret;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFax(): ?int
    {
        return $this->fax;
    }

    public function setFax(int $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getStatutjuridique(): ?string
    {
        return $this->statutjuridique;
    }

    public function setStatutjuridique(string $statutjuridique): self
    {
        $this->statutjuridique = $statutjuridique;

        return $this;
    }

    public function getCodeAPE(): ?string
    {
        return $this->codeAPE;
    }

    public function setCodeAPE(string $codeAPE): self
    {
        $this->codeAPE = $codeAPE;

        return $this;
    }

    public function getNumVoie(): ?int
    {
        return $this->numVoie;
    }

    public function setNumVoie(int $numVoie): self
    {
        $this->numVoie = $numVoie;

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

    public function getComplementadresse(): ?string
    {
        return $this->complementadresse;
    }

    public function setComplementadresse(?string $complementadresse): self
    {
        $this->complementadresse = $complementadresse;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
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

    /**
     * @return Collection|Representant[]
     */
    public function getRepresentants(): Collection
    {
        return $this->representants;
    }

    public function addRepresentant(Representant $representant): self
    {
        if (!$this->representants->contains($representant)) {
            $this->representants[] = $representant;
            $representant->setEntreprise($this);
        }

        return $this;
    }

    public function removeRepresentant(Representant $representant): self
    {
        if ($this->representants->removeElement($representant)) {
            // set the owning side to null (unless already changed)
            if ($representant->getEntreprise() === $this) {
                $representant->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setEntreprise($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getEntreprise() === $this) {
                $adress->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setEntreprise($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getEntreprise() === $this) {
                $commande->setEntreprise(null);
            }
        }

        return $this;
    }
}
