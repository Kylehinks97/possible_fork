<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\OneToMany(targetEntity: Building::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $buildings;

    public function __construct(string $name, array $buildings)
    {
        $this->name = $name;
        $this->buildings = new ArrayCollection($buildings);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBuildings(): Collection
    {
        return $this->buildings;
    }

    public function addBuilding(Building $building): static
    {
        if (!$this->buildings->contains($building)) {
            $this->buildings->add($building);

            $building->setProject($this);
        }

        return $this;
    }

    public function removeBuilding(Building $building): static
    {
        $this->buildings->removeElement($building);

        return $this;
    }
}
