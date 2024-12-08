<?php declare(strict_types=1);

namespace App\Entity\Surface;

use App\Repository\FloorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FloorRepository::class)]
#[ORM\Table(name: 'floor')]
class Floor extends Surface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
