<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use PHPUnit\Framework\TestCase;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

abstract class AbstractReqTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     */
    public function testGetName(string $name): void
    {
        $argument = $this->makeArgument($name);
        $this->assertEquals($name, $argument->getName());
    }

    abstract public function makeArgument(string $name): ArgumentInterface;

    /**
     * @dataProvider dataProvider
     * @param string $name
     */
    public function testGetPrefix(string $name): void
    {
        $argument = $this->makeArgument($name);
        $this->assertEquals("", $argument->getPrefix());
    }

    /**
     * @dataProvider dataProvider
     * @param string $name
     */
    public function testGetSuffix(string $name): void
    {
        $argument = $this->makeArgument($name);
        $this->assertEquals("", $argument->getSuffix());
    }

    /**
     * @dataProvider dataProvider
     * @param string $name
     */
    public function testIsRequired(string $name): void
    {
        $argument = $this->makeArgument($name);
        $this->assertEquals(true, $argument->isRequired());
    }

    public function dataProvider()
    {
        return [
            ['', ''],
            ['a', ''],
            ['ab', ''],
            ['abc', ''],

            ['', '/'],
            ['a', '/'],
            ['ab', '/'],
            ['abc', '/'],

            ['', '#'],
            ['a', '#'],
            ['ab', '#'],
            ['abc', '#'],
        ];
    }
}