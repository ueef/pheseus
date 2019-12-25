<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use TypeError;
use Ueef\Pheseus\Arguments\EnumReqArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class EnumReqArgumentTest extends AbstractReqTest
{
    /**
     * @dataProvider dataProvider
     * @param string $name
     * @param string $delimiter
     */
    public function testGetRegex(string $name, string $delimiter): void
    {
        $this->expectException(TypeError::class);
        foreach ([[], [""], ["a"], ["a", "b"], [1, 2, 3]] as $values) {
            $regexp = [];
            foreach ($values as $value) {
                $regexp[] = preg_quote($value, $delimiter);
            }

            $argument = $this->makeArgument($name, $values);
            $this->assertEquals(implode("|", $values), $argument->getRegex($delimiter));
        }
    }

    public function makeArgument(string $name, array $values = []): ArgumentInterface
    {
        return new EnumReqArgument($name, $values);
    }
}