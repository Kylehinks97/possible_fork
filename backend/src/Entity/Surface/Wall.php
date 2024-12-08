<?php declare(strict_types=1);

namespace App\Entity\Surface;

use App\Repository\WallRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WallRepository::class)]
#[ORM\Table(name: 'wall')]
class Wall extends Surface
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
