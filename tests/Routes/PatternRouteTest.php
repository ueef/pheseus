<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Routes;

use PHPUnit\Framework\TestCase;
use Throwable;
use Ueef\Pheseus\Arguments\StrArgument;
use Ueef\Pheseus\Arguments\StrReqArgument;
use Ueef\Pheseus\Exceptions\Route\DuplicatedArgumentNameRouteException;
use Ueef\Pheseus\Exceptions\Route\DuplicatedArgumentReplacementRouteException;
use Ueef\Pheseus\Exceptions\Route\IncorrectArgumentValueRouteException;
use Ueef\Pheseus\Exceptions\Route\MissingArgumentRouteException;
use Ueef\Pheseus\Exceptions\Route\UndefinedArgumentValueRouteException;
use Ueef\Pheseus\Routes\PatternRoute;

class PatternRouteTest extends TestCase
{
    public function testMissingArgument(): void
    {
        $e = null;
        try {
            new PatternRoute("/%a%/%c%", new StrArgument("a"), new StrArgument("b"), new StrArgument("c"));
        } catch (Throwable $e) {
        }

        $this->assertInstanceOf(MissingArgumentRouteException::class, $e);
    }

    public function testDuplicatedArgumentName(): void
    {
        $e = null;
        try {
            new PatternRoute("/%a%/%b%/%c%", new StrArgument("a"), new StrArgument("b"), new StrArgument("c"), new StrArgument("a"));
        } catch (Throwable $e) {
        }

        $this->assertInstanceOf(DuplicatedArgumentNameRouteException::class, $e);
    }

    public function testDuplicatedArgumentReplacement(): void
    {
        $e = null;
        try {
            new PatternRoute("/%a%/%b%/%c%", new StrArgument("a", "", "c%"), new StrArgument("b"), new StrArgument("c", "%a"));
        } catch (Throwable $e) {
        }

        $this->assertInstanceOf(DuplicatedArgumentReplacementRouteException::class, $e);
    }

    public function testGetPath(): void
    {
        $route = new PatternRoute(
            "/foo/%a%/%b%/qux",
            new StrReqArgument("a"),
            new StrArgument("b", "/"),
        );

        $this->assertEquals("/foo/bar/qux", $route->getPath(["a" => "bar"]));
        $this->assertEquals("/foo/bar/baz/qux", $route->getPath(["a" => "bar", "b" => "baz"]));

        $e = null;
        try {
            $route->getPath([]);
        } catch (Throwable $e) {
        }

        $this->assertInstanceOf(UndefinedArgumentValueRouteException::class, $e);

        $e = null;
        try {
            $route->getPath(["a" => ""]);
        } catch (Throwable $e) {
        }

        $this->assertInstanceOf(IncorrectArgumentValueRouteException::class, $e);
    }

    public function testMatch(): void
    {
        $route = new PatternRoute(
            "/foo/%a%/%b%/qux",
            new StrReqArgument("a"),
            new StrArgument("b", "/"),
        );

        $this->assertEquals(null, $route->match("/foo/qux"));
        $this->assertEquals(["a" => "bar"], $route->match("/foo/bar/qux"));
        $this->assertEquals(["a" => "bar", "b" => "baz"], $route->match("/foo/bar/baz/qux"));
    }
}