<?php declare(strict_types=1);

namespace App\Entity\Surface;

use App\Repository\CeilingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CeilingRepository::class)]
#[ORM\Table(name: 'wall')]
class Ceiling extends Surface
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
