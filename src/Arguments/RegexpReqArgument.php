<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class RegexpReqArgument extends RegexpArgument
{
    public function __construct(string $name, string $regexp)
    {
        parent::__construct($name, $regexp);
    }

    public function isRequired(): bool
    {
        return true;
    }
}