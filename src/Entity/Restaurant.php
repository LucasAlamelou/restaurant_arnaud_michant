<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $capacityMax = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Hours::class)]
    private Collection $hours;

    public function __construct()
    {
        $this->hours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacityMax(): ?int
    {
        return $this->capacityMax;
    }

    public function setCapacityMax(int $capacityMax): self
    {
        $this->capacityMax = $capacityMax;

        return $this;
    }

    /**
     * @return Collection<int, Hours>
     */
    public function getHours(): Collection
    {
        return $this->hours;
    }

    public function addHour(Hours $hour): self
    {
        if (!$this->hours->contains($hour)) {
            $this->hours->add($hour);
            $hour->setRestaurant($this);
        }

        return $this;
    }

    public function removeHour(Hours $hour): self
    {
        if ($this->hours->removeElement($hour)) {
            // set the owning side to null (unless already changed)
            if ($hour->getRestaurant() === $this) {
                $hour->setRestaurant(null);
            }
        }

        return $this;
    }
}
