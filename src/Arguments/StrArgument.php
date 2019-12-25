<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class StrArgument extends AbstractArgument
{
    public function __construct(string $name, string $prefix = "", string $suffix = "")
    {
        parent::__construct($name, $prefix, $suffix);
    }

    public function getRegex(string $delimiter): string
    {
        return ".+";
    }
}