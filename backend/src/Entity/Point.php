<?php

namespace App\Entity;

use App\Repository\PointRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a Point of a Surface.
 */
#[ORM\Entity(repositoryClass: PointRepository::class)]
class Point
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    private int $x;

    private int $y;

    #[ORM\ManyToOne(targetEntity: Surface::class, inversedBy: 'points')]
    #[ORM\JoinColumn(name: 'surface_id', referencedColumnName: 'id', nullable: false)]
    private Surface $surface;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    public function getSurface(): \App\Entity\Surface
    {
        return $this->surface;
    }

    public function setSurface(\App\Entity\Surface $surface): void
    {
        $this->surface = $surface;
    }
}
