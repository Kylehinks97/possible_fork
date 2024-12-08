<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Surface\Surface;
use App\Repository\EdgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EdgeRepository::class)]
class Edge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $length;

    #[ORM\ManyToOne(targetEntity: Surface::class, inversedBy: 'edges')]
    #[ORM\JoinColumn(name: 'surface_id', referencedColumnName: 'id', nullable: false)]
    private Surface $surface;

    public function __construct(int $length)
    {
        $this->length = $length;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): static
    {
        $this->length = $length;

        return $this;
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
