<?php

namespace App\Entity;

use App\Repository\ColorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorsRepository::class)]
class Colors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Masque>
     */
    #[ORM\ManyToMany(targetEntity: Masque::class, mappedBy: 'colors')]
    private Collection $masques;

    public function __construct()
    {
        $this->masques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Masque>
     */
    public function getMasques(): Collection
    {
        return $this->masques;
    }

    public function addMasque(Masque $masque): static
    {
        if (!$this->masques->contains($masque)) {
            $this->masques->add($masque);
            $masque->addColor($this);
        }

        return $this;
    }

    public function removeMasque(Masque $masque): static
    {
        if ($this->masques->removeElement($masque)) {
            $masque->removeColor($this);
        }

        return $this;
    }
}
