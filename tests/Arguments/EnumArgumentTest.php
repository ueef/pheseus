<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Tests\Arguments;

use TypeError;
use Ueef\Pheseus\Arguments\EnumArgument;
use Ueef\Pheseus\Interfaces\ArgumentInterface;

class EnumArgumentTest extends AbstractTest
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
        $this->expectException(TypeError::class);
        foreach ([[], [""], ["a"], ["a", "b"], [1, 2, 3]] as $values) {
            $regexp = [];
            foreach ($values as $value) {
                $regexp[] = preg_quote($value, $delimiter);
            }

            $argument = $this->makeArgument($name, $prefix, $suffix, $values);
            $this->assertEquals(implode("|", $values), $argument->getRegex($delimiter));
        }
    }

    public function makeArgument(string $name, string $prefix, string $suffix, array $values = []): ArgumentInterface
    {
        return new EnumArgument($name, $values, $prefix, $suffix);
    }
}