<?php declare(strict_types=1);

namespace App\Tests\Surface;

use App\Entity\Edge;
use App\Entity\Surface\Surface;
use App\Entity\Surface\Wall;
use App\Entity\Vertex;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class BasicSurfaceTest extends TestCase
{
    private Wall $wall;
    private array $vertices;
    private array $edges;

    protected function setUp(): void
    {
        $this->vertices = [
            new Vertex(20, 20),
            new Vertex(40, 20),
            new Vertex(40, 40),
            new Vertex(20, 40),
        ];

        $this->edges = [
            new Edge(100),
            new Edge(100),
            new Edge(100),
            new Edge(100),
        ];

        $this->wall = new Wall('Master Bedroom', $this->vertices, $this->edges);
    }

    public function test_basic_surface_area_calculation(): void
    {

        assertEquals(400, Surface::calculateArea($this->vertices));

        $newVertices = [
            new Vertex(0, 0),
            new Vertex(100, 0),
            new Vertex(100, 100),
            new Vertex(0, 100),
        ];

        assertEquals(10000, Surface::calculateArea($newVertices));
    }

    public function test_irregular_polygon(): void
    {
        $vertices = [
            new Vertex(0, 0),
            new Vertex(4, 0),
            new Vertex(4, 3),
            new Vertex(0, 4),
        ];

        // This shape is a trapezoid with an area of 14
        assertEquals(14, Surface::calculateArea($vertices));
    }

    public function test_non_intuitive_order(): void
    {
        $vertices = [
            new Vertex(4, 4),
            new Vertex(0, 4),
            new Vertex(0, 0),
            new Vertex(4, 0),
        ];

        // The area should still be 16, even though the order is different.
        assertEquals(16, Surface::calculateArea($vertices));
    }

    public function test_three_vertices(): void
    {
        $vertices = [
            new Vertex(0, 0),
            new Vertex(4, 0),
            new Vertex(0, 3),
        ];

        // The area of this triangle is (4 * 3) / 2 = 6
        assertEquals(6.0, Surface::calculateArea($vertices));
    }

    public function test_less_than_three_vertices(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $vertices = [
            new Vertex(0, 0),
            new Vertex(4, 0),
        ];

        // This should throw an exception because it's not a polygon.
        Surface::calculateArea($vertices);
    }
}