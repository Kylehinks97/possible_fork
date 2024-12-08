<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Surface\Surface;
use App\Repository\VertexRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a Vertex of a Surface.
 */
#[ORM\Entity(repositoryClass: VertexRepository::class)]
class Vertex
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    private int $x;

    private int $y;

    #[ORM\ManyToOne(targetEntity: Surface::class, inversedBy: 'vertices')]
    #[ORM\JoinColumn(name: 'surface_id', referencedColumnName: 'id', nullable: false)]
    private Surface $surface;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getId(): int
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

    public function getSurface(): Surface
    {
        return $this->surface;
    }

    public function setSurface(Surface $surface): void
    {
        $this->surface = $surface;
    }
}
