<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $hour = null;

    #[ORM\Column(length: 255)]
    private ?string $nameOfClient = null;

    #[ORM\Column]
    private ?int $nbCouvert = null;

    #[ORM\Column(length: 225, nullable: true)]
    private ?string $allergns = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getNameOfClient(): ?string
    {
        return $this->nameOfClient;
    }

    public function setNameOfClient(string $nameOfClient): self
    {
        $this->nameOfClient = $nameOfClient;

        return $this;
    }

    public function getNbCouvert(): ?int
    {
        return $this->nbCouvert;
    }

    public function setNbCouvert(int $nbCouvert): self
    {
        $this->nbCouvert = $nbCouvert;

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
}
