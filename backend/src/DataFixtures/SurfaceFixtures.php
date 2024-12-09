<?php

namespace App\DataFixtures;

use App\Entity\Edge;
use App\Entity\Surface\Surface;
use App\Entity\Surface\SurfaceType;
use App\Entity\Vertex;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SurfaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vertices = $this->generatePolygonVertices(random_int(4, 10));

        $edges = $this->generatePolygonEdges($vertices);

        $surface = new Surface(
            'Test Surface',
            new SurfaceType('Ceiling'),
            $vertices,
            $edges
        );

        $manager->persist($surface);
        $manager->flush();
    }

    private function generatePolygonVertices(int $numVertices): array
    {
        $vertices = [];
        $angleIncrement = 360 / $numVertices;
        $centerX = 50;
        $centerY = 50;
        $radius = 40;

        for ($i = 0; $i < $numVertices; $i++) {
            $angle = deg2rad($i * $angleIncrement);
            $x = $centerX + $radius * cos($angle);
            $y = $centerY + $radius * sin($angle);
            $vertices[] = new Vertex(round($x), round($y));
        }

        return $vertices;
    }

    private function generatePolygonEdges(array $vertices): array
    {
        $edges = [];
        $numVertices = count($vertices);

        foreach ($vertices as $i => $iValue) {
            $startVertex = $iValue;
            $endVertex = $vertices[($i + 1) % $numVertices];

            $edgeLength = $this->calculateDistance($startVertex, $endVertex);

            $edges[] = new Edge($edgeLength);
        }

        return $edges;
    }

    private function calculateDistance(Vertex $start, Vertex $end): float
    {
        $dx = $end->getX() - $start->getX();
        $dy = $end->getY() - $start->getY();

        return sqrt($dx * $dx + $dy * $dy);
    }
}
