<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Routes;

use PHPUnit\Framework\TestCase;
use Ueef\Pheseus\Routes\DirectRoute;
use Ueef\Pheseus\Routes\PrefixRoute;

class PrefixRouteTest extends TestCase
{
    public function testMatch(): void
    {
        $prefix = "/foo";
        $path = "/bar";
        $route = new PrefixRoute($prefix, new DirectRoute($path));
        $this->assertEquals([], $route->match($prefix . $path));
        $this->assertEquals(null, $route->match($prefix));
        $this->assertEquals(null, $route->match($path));
        $this->assertEquals(null, $route->match(""));
    }

    public function testGetPath(): void
    {
        $prefix = "/foo";
        $path = "/bar";
        $route = new PrefixRoute($prefix, new DirectRoute($path));
        $this->assertEquals($prefix . $path, $route->getPath());
    }
}