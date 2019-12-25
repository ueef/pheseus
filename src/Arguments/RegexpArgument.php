<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

class RegexpArgument extends AbstractArgument
{
    private string $regexp;


    public function __construct(string $name, string $regexp, string $prefix = "", string $suffix = "")
    {
        $this->regexp = $regexp;
        parent::__construct($name, $prefix, $suffix);
    }

    public function getRegex(string $delimiter): string
    {
        return $this->regexp;
    }
}