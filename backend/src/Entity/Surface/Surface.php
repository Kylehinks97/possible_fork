<?php declare(strict_types=1);

namespace App\Entity\Surface;

use App\Entity\Edge;
use App\Entity\Vertex;
use App\Repository\SurfaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * Represents an abstract Surface entity that can be extended by specific types like Wall, Ceiling, Floor, Door and Window.
 */
#[ORM\Table(name: 'surface')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'surface' => 'Surface',
    'wall' => 'Wall',
    'ceiling' => 'Ceiling',
    'floor' => 'Floor'
])]
#[ORM\Entity(repositoryClass: SurfaceRepository::class)]
abstract class Surface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(targetEntity: Vertex::class, mappedBy: 'surface', cascade: ['persist', 'remove'])]
    private Collection $vertices;

    #[ORM\OneToMany(targetEntity: Edge::class, mappedBy: 'edge', cascade: ['persist', 'remove'])]
    private Collection $edges;

    public function __construct(string $name, array $vertices, array $edges)
    {
        $this->name = $name;
        $this->vertices = new ArrayCollection($vertices);
        $this->edges = new ArrayCollection($edges);
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

    public function getVerticesAsArray(): array
    {
        return $this->vertices->toArray();
    }

    public function getVerticesAsCollection(): ArrayCollection
    {
        return $this->vertices;
    }

    public function setVertices(Collection $vertices): void
    {
        $this->vertices = $vertices;
    }

    public function getEdgesAsArray(): array
    {
        return $this->edges->toArray();
    }

    public function getEdgesAsCollection(): ArrayCollection
    {
        return $this->edges;
    }

    public static function calculateArea(array $vertices): float
    {
        $numVertices = count($vertices);
        if ($numVertices < 3) {
            throw new InvalidArgumentException('A polygon must have at least three vertices.');
        }

        $area = 0.0;

        foreach ($vertices as $i => $current) {
            $next = $vertices[($i + 1) % $numVertices];

            $area += $current->getX() * $next->getY();
            $area -= $current->getY() * $next->getX();
        }

        return abs($area) / 2.0;
    }
}
