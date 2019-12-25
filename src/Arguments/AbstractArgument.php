<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Arguments;

use Ueef\Pheseus\Interfaces\ArgumentInterface;

abstract class AbstractArgument implements ArgumentInterface
{
    private string $name;
    private string $prefix;
    private string $suffix;

    public function __construct(string $name, string $prefix = "", string $suffix = "")
    {
        $this->name = $name;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getSuffix(): string
    {
        return $this->suffix;
    }

    public function isRequired(): bool
    {
        return false;
    }
}