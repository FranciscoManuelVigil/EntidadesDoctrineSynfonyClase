<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firshName = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $birthDate = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'creator', orphanRemoval: true)]
    private Collection $creator_task;

    public function __construct()
    {
        $this->creator_task = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirshName(): ?string
    {
        return $this->firshName;
    }

    public function setFirshName(string $firshName): static
    {
        $this->firshName = $firshName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTime $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getCreatorTask(): Collection
    {
        return $this->creator_task;
    }

    public function addCreatorTask(Task $creatorTask): static
    {
        if (!$this->creator_task->contains($creatorTask)) {
            $this->creator_task->add($creatorTask);
            $creatorTask->setCreator($this);
        }

        return $this;
    }

    public function removeCreatorTask(Task $creatorTask): static
    {
        if ($this->creator_task->removeElement($creatorTask)) {
            // set the owning side to null (unless already changed)
            if ($creatorTask->getCreator() === $this) {
                $creatorTask->setCreator(null);
            }
        }

        return $this;
    }
}
