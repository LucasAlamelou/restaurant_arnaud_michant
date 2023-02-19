<?php

namespace App\Entity;

use App\Repository\CategoriesOfPlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesOfPlatRepository::class)]
class CategoriesOfPlat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categoriesOfPlat', targetEntity: PlatOfRestaurant::class)]
    private Collection $platOfRestaurants;

    public function __construct()
    {
        $this->platOfRestaurants = new ArrayCollection();
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

    /**
     * @return Collection<int, PlatOfRestaurant>
     */
    public function getPlatOfRestaurants(): Collection
    {
        return $this->platOfRestaurants;
    }

    public function addPlatOfRestaurant(PlatOfRestaurant $platOfRestaurant): self
    {
        if (!$this->platOfRestaurants->contains($platOfRestaurant)) {
            $this->platOfRestaurants->add($platOfRestaurant);
            $platOfRestaurant->setCategoriesOfPlat($this);
        }

        return $this;
    }

    public function removePlatOfRestaurant(PlatOfRestaurant $platOfRestaurant): self
    {
        if ($this->platOfRestaurants->removeElement($platOfRestaurant)) {
            // set the owning side to null (unless already changed)
            if ($platOfRestaurant->getCategoriesOfPlat() === $this) {
                $platOfRestaurant->setCategoriesOfPlat(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
