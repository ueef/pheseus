<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class EnumArgument extends AbstractArgument
{
    /** @var string[] */
    private array $values;


    public function __construct(string $name, array $values, string $prefix = "", string $suffix = "")
    {
        parent::__construct($name, $prefix, $suffix);
        $this->setValues(...$values);
    }

    private function setValues(string ...$values)
    {
        $this->values = $values;
    }

    public function getRegex(string $delimiter): string
    {
        $values = [];
        foreach ($this->values as $value) {
            $values[] = preg_quote($value, $delimiter);
        }

        return implode("|", $values);
    }
}