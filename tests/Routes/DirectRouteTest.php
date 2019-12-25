<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Routes;

use PHPUnit\Framework\TestCase;
use Ueef\Pheseus\Routes\DirectRoute;

class DirectRouteTest extends TestCase
{
    public function testMatch(): void
    {
        $path = "/foo/bar";
        $route = new DirectRoute($path);
        $this->assertEquals([], $route->match($path));
        $this->assertEquals(null, $route->match("/foo"));
        $this->assertEquals(null, $route->match("/foo/bar/baz"));
    }

    public function testGetPath(): void
    {
        $path = "/foo/bar";
        $route = new DirectRoute($path);
        $this->assertEquals($path, $route->getPath());
        $this->assertEquals($path, $route->getPath(["a" => 1]));
        $this->assertEquals($path, $route->getPath(["a" => 1, "b" => 2]));
    }
}