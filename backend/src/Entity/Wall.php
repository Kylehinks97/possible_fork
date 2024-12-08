<?php

namespace App\Entity;

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

    public function getId(): ?int
    {
        return $this->id;
    }
}
