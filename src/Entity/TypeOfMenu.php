<?php

namespace App\Entity;

use App\Repository\TypeOfMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOfMenuRepository::class)]
class TypeOfMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'TypeOfMenu', targetEntity: FormuleInMenu::class)]
    private Collection $formuleInMenus;

    public function __construct()
    {
        $this->formuleInMenus = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, FormuleInMenu>
     */
    public function getFormuleInMenus(): Collection
    {
        return $this->formuleInMenus;
    }

    public function addFormuleInMenu(FormuleInMenu $formuleInMenu): self
    {
        if (!$this->formuleInMenus->contains($formuleInMenu)) {
            $this->formuleInMenus->add($formuleInMenu);
            $formuleInMenu->setTypeOfMenu($this);
        }

        return $this;
    }

    public function removeFormuleInMenu(FormuleInMenu $formuleInMenu): self
    {
        if ($this->formuleInMenus->removeElement($formuleInMenu)) {
            // set the owning side to null (unless already changed)
            if ($formuleInMenu->getTypeOfMenu() === $this) {
                $formuleInMenu->setTypeOfMenu(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}
