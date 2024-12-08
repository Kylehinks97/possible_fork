<?php declare(strict_types=1);

namespace App\Tests\Wall;

use App\Entity\Edge;
use App\Entity\Surface\Wall;
use App\Entity\Vertex;
use PHPUnit\Framework\TestCase;

class BasicWallTest extends TestCase
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

    public function test_get_vertices_as_array()
    {
        $result = $this->wall->getVerticesAsArray();

        $this->assertIsArray($result);

        $this->assertCount(count($this->vertices), $result);

        foreach ($result as $index => $vertex) {
            $this->assertSame($this->vertices[$index], $vertex);
        }
    }

    public function test_get_vertices_as_collection()
    {
        $result = $this->wall->getVerticesAsCollection();

        $this->assertCount(count($this->vertices), $result);

        foreach ($result as $index => $vertex) {
            $this->assertSame($this->vertices[$index], $vertex);
        }
    }

    public function test_get_edges_as_array()
    {
        $result = $this->wall->getEdgesAsArray();

        $this->assertIsArray($result);

        $this->assertCount(count($this->edges), $result);

        foreach ($result as $index => $edge) {
            $this->assertSame($this->edges[$index], $edge);
        }
    }

    public function test_get_edges_as_collection()
    {
        $result = $this->wall->getEdgesAsCollection();

        $this->assertCount(count($this->edges), $result);

        foreach ($result as $index => $edge) {
            $this->assertSame($this->edges[$index], $edge);
        }
    }
}