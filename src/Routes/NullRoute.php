<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Routes;

use Ueef\Pheseus\Interfaces\RouteInterface;

class NullRoute implements RouteInterface
{
    public function match(string $path): ?array
    {
        return null;
    }

    public function getPath(array $args = []): string
    {
        return "";
    }
}