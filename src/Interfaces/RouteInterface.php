<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Interfaces;

interface RouteInterface
{
    public function match(string $path): ?array;

    public function getPath(array $args = []): string;
}