<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\SurfaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private ?string $name;

    #[ORM\OneToMany(targetEntity: Point::class, mappedBy: 'surface', cascade: ['persist', 'remove'])]
    private Collection $points;

    public function __construct(string $name, array $points)
    {
        $this->name = $name;
        $this->points = new ArrayCollection($points);
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

    public function getPointsAsArray(): array
    {
        return $this->points->toArray();
    }

    public function getPointsAsCollection(): ArrayCollection
    {
        return $this->points;
    }

    public function setPoints(Collection $points): void
    {
        $this->points = $points;
    }
}
