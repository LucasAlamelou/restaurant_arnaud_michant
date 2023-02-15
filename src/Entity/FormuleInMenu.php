<?php

namespace App\Entity;

use App\Repository\FormuleInMenuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormuleInMenuRepository::class)]
class FormuleInMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'formuleInMenus')]
    private ?TypeOfMenu $TypeOfMenu = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeOfMenu(): ?TypeOfMenu
    {
        return $this->TypeOfMenu;
    }

    public function setTypeOfMenu(?TypeOfMenu $TypeOfMenu): self
    {
        $this->TypeOfMenu = $TypeOfMenu;

        return $this;
    }
}
