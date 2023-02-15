<?php

namespace App\Entity;

use App\Repository\PlatOfRestaurantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatOfRestaurantRepository::class)]
class PlatOfRestaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'platOfRestaurants')]
    private ?CategoriesOfPlat $categoriesOfPlat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategoriesOfPlat(): ?CategoriesOfPlat
    {
        return $this->categoriesOfPlat;
    }

    public function setCategoriesOfPlat(?CategoriesOfPlat $categoriesOfPlat): self
    {
        $this->categoriesOfPlat = $categoriesOfPlat;

        return $this;
    }
}
