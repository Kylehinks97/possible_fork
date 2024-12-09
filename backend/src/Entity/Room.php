<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Surface\Surface;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(targetEntity: Surface::class, mappedBy: 'room', orphanRemoval: true)]
    private Collection $surfaces;

    #[ORM\ManyToOne(inversedBy: 'room')]
    #[ORM\JoinColumn(nullable: false)]
    private Building $building;

    public function __construct(string $name, array $surfaces)
    {
        $this->name = $name;
        $this->surfaces = new ArrayCollection($surfaces);
    }

    public static function calculateArea(array $surfaces): float
    {
        $total = 0;

        foreach ($surfaces as $surface) {
            $total += Surface::calculateArea($surface->getVerticesAsArray());
        }

        return $total;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurfacesAsCollection(): Collection
    {
        return $this->surfaces;
    }

    public function getSurfacesAsArray(): array
    {
        return $this->surfaces->toArray();
    }

    public function addSurface(Surface $surface): static
    {
        if (!$this->surfaces->contains($surface)) {
            $this->surfaces->add($surface);

            $surface->setRoom($this);
        }

        return $this;
    }

    public function removeSurface(Surface $surface): static
    {
        $this->surfaces->removeElement($surface);

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): static
    {
        $this->building = $building;

        return $this;
    }
}
