<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use Ueef\Pheseus\Arguments\IntArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class IntArgumentTest extends AbstractTest
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $prefix
     * @param string $suffix
     * @param string $delimiter
     */
    public function testGetRegex(string $name, string $prefix, string $suffix, string $delimiter): void
    {
        $argument = $this->makeArgument($name, $prefix, $suffix);
        $this->assertEquals("\d+", $argument->getRegex($delimiter));
    }

    public function makeArgument(string $name, string $prefix, string $suffix): ArgumentInterface
    {
        return new IntArgument($name, $prefix, $suffix);
    }
}