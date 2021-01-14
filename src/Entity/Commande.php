<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transporteurnom;

    /**
     * @ORM\Column(type="float")
     */
    private $transporteurprix;

    /**
     * @ORM\Column(type="text")
     */
    private $delivre;

    /**
     * @ORM\OneToMany(targetEntity=CommandeDetail::class, mappedBy="commande")
     */
    private $commandeDetails;
    


    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid;

    public function __construct()
    {
        $this->commandeDetails = new ArrayCollection();
    }

    public function getTotal() {
        $total = null;

        foreach ($this->getCommandeDetails()->getValues() as $product) {
            $total = $total + ($product->getPrix() * $product->getQuantite());
        }
        return $total;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTransporteurnom(): ?string
    {
        return $this->transporteurnom;
    }

    public function setTransporteurnom(string $transporteurnom): self
    {
        $this->transporteurnom = $transporteurnom;

        return $this;
    }

    public function getTransporteurprix(): ?float
    {
        return $this->transporteurprix;
    }

    public function setTransporteurprix(float $transporteurprix): self
    {
        $this->transporteurprix = $transporteurprix;

        return $this;
    }

    public function getDelivre(): ?string
    {
        return $this->delivre;
    }

    public function setDelivre(string $delivre): self
    {
        $this->delivre = $delivre;

        return $this;
    }

    /**
     * @return Collection|CommandeDetail[]
     */
    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if (!$this->commandeDetails->contains($commandeDetail)) {
            $this->commandeDetails[] = $commandeDetail;
            $commandeDetail->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if ($this->commandeDetails->removeElement($commandeDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandeDetail->getCommande() === $this) {
                $commandeDetail->setCommande(null);
            }
        }

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }
}
