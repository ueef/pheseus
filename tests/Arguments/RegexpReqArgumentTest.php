<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use Ueef\Pheseus\Arguments\RegexpReqArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class RegexpReqArgumentTest extends AbstractReqTest
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $delimiter
     */
    public function testGetRegex(string $name, string $delimiter): void
    {
        foreach (["", ".+", ".*", "(:?(:<a>[\w\.][^\d]\W))?"] as $regexp) {
            $argument = $this->makeArgument($name, $regexp);
            $this->assertEquals($regexp, $argument->getRegex($delimiter));
        }
    }

    public function makeArgument(string $name, string $regexp = ""): ArgumentInterface
    {
        return new RegexpReqArgument($name, $regexp);
    }
}