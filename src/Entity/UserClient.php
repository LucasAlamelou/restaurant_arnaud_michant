<?php

namespace App\Entity;

use App\Repository\UserClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserClientRepository::class)]
class UserClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergns = null;

    #[ORM\Column]
    private ?int $nbCouvertDefault = null;

    #[ORM\OneToOne(inversedBy: 'userClient', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAllergns(): ?string
    {
        return $this->allergns;
    }

    public function setAllergns(?string $allergns): self
    {
        $this->allergns = $allergns;

        return $this;
    }

    public function getNbCouvertDefault(): ?int
    {
        return $this->nbCouvertDefault;
    }

    public function setNbCouvertDefault(int $nbCouvertDefault): self
    {
        $this->nbCouvertDefault = $nbCouvertDefault;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
