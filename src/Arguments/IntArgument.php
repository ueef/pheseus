<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class IntArgument extends AbstractArgument
{
    public function getRegex(string $delimiter): string
    {
        return "\d+";
    }
}