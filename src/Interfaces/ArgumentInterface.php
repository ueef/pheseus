<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Interfaces;

interface ArgumentInterface
{
    public function getName(): string;

    public function getRegex(string $delimiter): string;

    public function getPrefix(): string;

    public function getSuffix(): string;

    public function isRequired(): bool;
}