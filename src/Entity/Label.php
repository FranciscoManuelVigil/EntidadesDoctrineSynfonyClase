<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LabelRepository::class)]
class Label
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 50, unique: true)]
    private ?string $shortName = null;

    #[ORM\Column]
    private ?bool $isActived = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): static
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function isActived(): ?bool
    {
        return $this->isActived;
    }

    public function setIsActived(bool $isActived): static
    {
        $this->isActived = $isActived;

        return $this;
    }
}
