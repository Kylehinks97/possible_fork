<?php declare(strict_types=1);

namespace App\Entity\Surface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a type of surface (e.g., wall, ceiling, floor, etc.).
 */
#[ORM\Entity]
#[ORM\Table(name: 'surface_type')]
class SurfaceType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
