<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use Ueef\Pheseus\Arguments\StrReqArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class StrReqArgumentTest extends AbstractReqTest
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $delimiter
     */
    public function testGetRegex(string $name, string $delimiter): void
    {
        $argument = $this->makeArgument($name);
        $this->assertEquals(".+", $argument->getRegex($delimiter));
    }

    public function makeArgument(string $name): ArgumentInterface
    {
        return new StrReqArgument($name);
    }
}