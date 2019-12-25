<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Routes;

use Ueef\Pheseus\Interfaces\RouteInterface;

class PrefixRoute implements RouteInterface
{
    private RouteInterface $route;
    private string $prefix;
    private int $prefix_length;


    public function __construct(string $prefix, RouteInterface $route)
    {
        $this->route = $route;
        $this->prefix = $prefix;
        $this->prefix_length = strlen($prefix);
    }

    public function getPath(array $args = []): string
    {
        return $this->prefix . $this->route->getPath($args);
    }

    public function match(string $path): ?array
    {
        if (0 === stripos($path, $this->prefix)) {
            return $this->route->match(substr($path, $this->prefix_length));
        }

        return null;
    }
}