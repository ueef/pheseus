<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use Ueef\Pheseus\Arguments\IntReqArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class IntReqArgumentTest extends AbstractReqTest
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $delimiter
     */
    public function testGetRegex(string $name, string $delimiter): void
    {
        $argument = $this->makeArgument($name);
        $this->assertEquals("\d+", $argument->getRegex($delimiter));
    }

    public function makeArgument(string $name): ArgumentInterface
    {
        return new IntReqArgument($name);
    }
}