<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Routes;

use PHPUnit\Framework\TestCase;
use Ueef\Pheseus\Routes\NullRoute;

class NullRouteTest extends TestCase
{
    public function testMatch(): void
    {
        $route = new NullRoute();
        $this->assertEquals(null, $route->match(""));
    }

    public function testGetPath(): void
    {
        $route = new NullRoute();
        $this->assertEquals("", $route->getPath());
    }
}