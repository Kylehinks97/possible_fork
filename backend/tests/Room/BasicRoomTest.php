<?php declare(strict_types=1);

namespace App\Tests\Room;

use App\Entity\Edge;
use App\Entity\Room;
use App\Entity\Surface\Surface;
use App\Entity\Vertex;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotContains;

class BasicRoomTest extends TestCase
{
    private Room $room;

    protected function setUp(): void
    {
        $firstVertices = [
            new Vertex(0, 0 ),
            new Vertex(50, 0 ),
            new Vertex(50, 50 ),
            new Vertex(0, 50 )
        ];

        $firstEdges = [
            new Edge(100),
            new Edge(100),
            new Edge(100),
            new Edge(100),
        ];

        $secondVertices = [
            new Vertex(0, 0 ),
            new Vertex(80, 0 ),
            new Vertex(80, 80 ),
            new Vertex(0, 80 )
        ];

        $secondEdges = [
            new Edge(150),
            new Edge(150),
            new Edge(150),
            new Edge(150),
        ];

        $surfaces = [
          new Surface($firstVertices, $firstEdges),
          new Surface($secondVertices, $secondEdges),
        ];

        $this->room = new Room('Test room', $surfaces);
    }

   public function test_I_can_add_and_remove_surfaces_from_a_room(): void
   {
       $surfaces = $this->room->getSurfacesAsCollection();

       $firstSurface = $surfaces[0];
       $secondSurface = $surfaces[1];

       $this->room->removeSurface($firstSurface);

       assertCount(1, $surfaces);
       assertContains($secondSurface, $surfaces);
       assertNotContains($firstSurface, $surfaces);

       $this->room->addSurface($firstSurface);

       assertCount(2, $surfaces);
       assertContains($firstSurface, $surfaces);
       assertContains($secondSurface, $surfaces);
   }

   public function test_I_can_aggregate_area_of_all_of_a_rooms_surfaces(): void
   {
       $surfaces = $this->room->getSurfacesAsArray();

       $total = Room::calculateArea($surfaces);

       self::assertEquals(8900, $total);
   }
}