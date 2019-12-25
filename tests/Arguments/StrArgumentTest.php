<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use Ueef\Pheseus\Arguments\StrArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class StrArgumentTest extends AbstractTest
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
        $this->assertEquals(".+", $argument->getRegex($delimiter));
    }

    public function makeArgument(string $name, string $prefix, string $suffix): ArgumentInterface
    {
        return new StrArgument($name, $prefix, $suffix);
    }
}