<?php

declare(strict_types=1);

namespace Ueef\Pheseus\Routes;

use Ueef\Pheseus\Exceptions\Route\DuplicatedArgumentNameRouteException;
use Ueef\Pheseus\Exceptions\Route\DuplicatedArgumentReplacementRouteException;
use Ueef\Pheseus\Exceptions\Route\IncorrectArgumentValueRouteException;
use Ueef\Pheseus\Exceptions\Route\MissingArgumentRouteException;
use Ueef\Pheseus\Exceptions\Route\UndefinedArgumentValueRouteException;
use Ueef\Pheseus\Interfaces\ArgumentInterface;
use Ueef\Pheseus\Interfaces\RouteInterface;

class PatternRoute implements RouteInterface
{
    private const WRAPPER = "%";
    private const REGEXP_DELIMITER = "/";

    private string $pattern;
    private string $matching_pattern;
    /** @var ArgumentInterface[] */
    private array $arguments_by_name;
    /** @var ArgumentInterface[] */
    private array $arguments_by_replacement;


    public function __construct(string $pattern, ArgumentInterface ...$arguments)
    {
        $this->setArguments(...$arguments);
        $this->setPattern($pattern);
    }

    private function setArguments(ArgumentInterface ...$arguments): void
    {
        $this->arguments_by_name = [];
        $this->arguments_by_replacement = [];
        foreach ($arguments as $argument) {
            $name = $argument->getName();
            if (isset($this->arguments_by_name[$name])) {
                throw new DuplicatedArgumentNameRouteException(sprintf("the argument with the same name \"%s\" has already been defined", $name));
            }

            $replacement = $this->makeArgumentReplacement($argument);
            if (isset($this->arguments_by_replacement[$replacement])) {
                throw new DuplicatedArgumentReplacementRouteException(sprintf("the argument with the same replacement \"%s\" has already been defined", $replacement));
            }

            $this->arguments_by_name[$name] = $argument;
            $this->arguments_by_replacement[$replacement] = $argument;
        }
    }

    private function makeArgumentReplacement(ArgumentInterface $argument): string
    {
        return $argument->getPrefix() . self::WRAPPER . $argument->getName() . self::WRAPPER . $argument->getSuffix();
    }

    private function setPattern(string $pattern): void
    {
        $parts = [];
        $this->pattern = $pattern;
        foreach ($this->arguments_by_replacement as $replacement => $argument) {
            $pos = strpos($this->pattern, $replacement);
            if (false === $pos) {
                throw new MissingArgumentRouteException(sprintf("the pattern \"%s\" doesn't contain the argument's replacement \"%s\"", $pattern, $replacement));
            }

            $parts[] = $pos;
            $parts[] = $pos + strlen($replacement);
        }
        sort($parts);
        $parts[] = strlen($pattern);

        $odd = true;
        $prev = 0;
        $pattern = "";
        foreach ($parts as $pos) {
            $part = substr($this->pattern, $prev, $pos - $prev);
            if ($odd) {
                $part = preg_quote($part, self::REGEXP_DELIMITER);
            }

            $pattern .= $part;
            $prev = $pos;
            $odd = !$odd;
        }

        $r = [];
        foreach ($this->arguments_by_replacement as $replacement => $argument) {
            $r[$replacement] = $this->makeArgumentRegexp($argument);
        }

        $this->matching_pattern = $this->makeRegexp(strtr($pattern, $r));
    }

    private function makeArgumentRegexp(ArgumentInterface $argument)
    {
        $name = $argument->getName();
        $prefix = preg_quote($argument->getPrefix(), self::REGEXP_DELIMITER);
        $suffix = preg_quote($argument->getSuffix(), self::REGEXP_DELIMITER);
        $regexp = $argument->getRegex(self::REGEXP_DELIMITER);

        return "(?:{$prefix}(?<{$name}>{$regexp}){$suffix})" . ($argument->isRequired() ? "" : "?");
    }

    private function makeRegexp(string $pattern)
    {
        return self::REGEXP_DELIMITER . "^" . $pattern . "$" . self::REGEXP_DELIMITER . "iuU";
    }

    public function match(string $path): ?array
    {
        if (!preg_match($this->matching_pattern, $path, $matches)) {
            return null;
        }

        return array_intersect_key($matches, $this->arguments_by_name);
    }

    public function getPath(array $args = []): string
    {
        $replacements = [];
        foreach ($this->arguments_by_replacement as $replacement => $argument) {
            $name = $argument->getName();
            if (isset($args[$name])) {
                $replacements[$replacement] = $argument->getPrefix() . $args[$name] . $argument->getSuffix();
            } elseif (!$argument->isRequired()) {
                $replacements[$replacement] = "";
            } else {
                throw new UndefinedArgumentValueRouteException(sprintf("the value of the required argument \"%s\" is undefined", $name));
            }
        }

        $path = strtr($this->pattern, $replacements);
        if (!preg_match($this->matching_pattern, $path)) {
            throw new IncorrectArgumentValueRouteException(sprintf("the resulting path \"%s\" doesn't match the route \"%s\"", $path, $this->matching_pattern));
        }

        return $path;
    }
}