<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use Ueef\Pheseus\Arguments\RegexpArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class RegexpArgumentTest extends AbstractTest
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
        foreach (["", ".+", ".*", "(:?(:<a>[\w\.][^\d]\W))?"] as $regexp) {
            $argument = $this->makeArgument($name, $prefix, $suffix, $regexp);
            $this->assertEquals($regexp, $argument->getRegex($delimiter));
        }
    }

    public function makeArgument(string $name, string $prefix, string $suffix, string $regexp = ""): ArgumentInterface
    {
        return new RegexpArgument($name, $regexp, $prefix, $suffix);
    }
}