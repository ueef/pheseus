<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Routes;

use Ueef\Pheseus\Interfaces\RouteInterface;

class DirectRoute implements RouteInterface
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function match(string $path): ?array
    {
        return $this->path == $path ? [] : null;
    }

    public function getPath(array $args = []): string
    {
        return $this->path;
    }
}