<?php

declare(strict_types=1);

namespace App\helpers;

class Format {

    public static function formatPath(string $path): string{
        $queryPosition = strpos($path, '?');

        if ($queryPosition === false) {
            return $path;
        }

        return explode('?', $path)[0];
    }
    
}