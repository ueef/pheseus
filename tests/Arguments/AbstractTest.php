<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use PHPUnit\Framework\TestCase;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

abstract class AbstractTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $prefix
     * @param string $suffix
     */
    public function testGetName(string $name, string $prefix, string $suffix): void
    {
        $argument = $this->makeArgument($name, $prefix, $suffix);
        $this->assertEquals($name, $argument->getName());
    }

    abstract public function makeArgument(string $name, string $prefix, string $suffix): ArgumentInterface;

    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $prefix
     * @param string $suffix
     */
    public function testGetPrefix(string $name, string $prefix, string $suffix): void
    {
        $argument = $this->makeArgument($name, $prefix, $suffix);
        $this->assertEquals($prefix, $argument->getPrefix());
    }

    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $prefix
     * @param string $suffix
     */
    public function testGetSuffix(string $name, string $prefix, string $suffix): void
    {
        $argument = $this->makeArgument($name, $prefix, $suffix);
        $this->assertEquals($suffix, $argument->getSuffix());
    }

    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $prefix
     * @param string $suffix
     */
    public function testIsRequired(string $name, string $prefix, string $suffix): void
    {
        $argument = $this->makeArgument($name, $prefix, $suffix);
        $this->assertEquals(false, $argument->isRequired());
    }

    public function dataProvider()
    {
        return [
            ['', '', '', ''],
            ['a', '/', '', ''],
            ['ab', '', '/', ''],
            ['abc', '/', '/', ''],

            ['', '', '', '/'],
            ['a', '/', '', '/'],
            ['ab', '', '/', '/'],
            ['abc', '/', '/', '/'],

            ['', '', '', '#'],
            ['a', '/', '', '#'],
            ['ab', '', '/', '#'],
            ['abc', '/', '/', '#'],
        ];
    }
}