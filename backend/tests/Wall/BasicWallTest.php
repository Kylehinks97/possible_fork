<?php declare(strict_types=1);

namespace App\Tests\Wall;

use App\Entity\Point;
use App\Entity\Wall;
use PHPUnit\Framework\TestCase;

class BasicWallTest extends TestCase
{
    private Wall $wall;
    private array $points;

    protected function setUp(): void
    {
        $this->points = [
            new Point(20, 20),
            new Point(40, 20),
            new Point(40, 40),
            new Point(20, 40),
        ];

        $this->wall = new Wall('Master Bedroom', $this->points);
    }

    public function test_get_points_as_array()
    {
        $result = $this->wall->getPointsAsArray();

        $this->assertIsArray($result);

        $this->assertCount(count($this->points), $result);

        foreach ($result as $index => $point) {
            $this->assertSame($this->points[$index], $point);
        }
    }

    public function test_get_points_as_collection()
    {
        $result = $this->wall->getPointsAsCollection();

        $this->assertCount(count($this->points), $result);

        foreach ($result as $index => $point) {
            $this->assertSame($this->points[$index], $point);
        }
    }
}