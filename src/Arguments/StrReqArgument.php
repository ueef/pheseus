<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class StrReqArgument extends StrArgument
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function isRequired(): bool
    {
        return true;
    }
}