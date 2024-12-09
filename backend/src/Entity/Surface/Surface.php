<?php declare(strict_types=1);

namespace App\Entity\Surface;

use App\Entity\Edge;
use App\Entity\Room;
use App\Entity\Vertex;
use App\Repository\SurfaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[ORM\Table(name: 'surface')]
#[ORM\Entity(repositoryClass: SurfaceRepository::class)]
class Surface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: SurfaceType::class)]
    #[ORM\JoinColumn(name: 'type_id', referencedColumnName: 'id', nullable: false)]
    private SurfaceType $type;

    #[ORM\OneToMany(targetEntity: Vertex::class, mappedBy: 'surface', cascade: ['persist', 'remove'])]
    private Collection $vertices;

    #[ORM\OneToMany(targetEntity: Edge::class, mappedBy: 'edge', cascade: ['persist', 'remove'])]
    private Collection $edges;

    #[ORM\ManyToOne(inversedBy: 'surfaces')]
    #[ORM\JoinColumn(nullable: false)]
    private Room $room;

    public function __construct(string $name, SurfaceType $type, array $vertices, array $edges)
    {
        $this->name = $name;
        $this->type = $type;
        $this->vertices = new ArrayCollection($vertices);
        $this->edges = new ArrayCollection($edges);
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }
}
