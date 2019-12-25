<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class EnumReqArgument extends EnumArgument
{
    public function __construct(string $name, array $values)
    {
        parent::__construct($name, $values);
    }

    public function isRequired(): bool
    {
        return true;
    }
}