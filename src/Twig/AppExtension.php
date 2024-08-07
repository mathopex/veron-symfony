<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('filter_name', [$this, 'doSomething']),
            new TwigFilter('ellipsis', [$this, 'makeEllipsis']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    public function makeEllipsis(string $text, int $length = 20): string
    {
        $dots = strlen($text) > $length ? '...' : '';
        return substr($text, 0, $length) . $dots;
    }
}