<?php

declare(strict_types=1);

namespace app\Helpers;

class Format {

    public static Format $format;

    public function __construct()
    {
        self::$format = $this;
    }

    public static function formatPath(string $path): string{
        $queryPosition = strpos($path, '?');

        if ($queryPosition === false) {
            return $path;
        }

        return explode('?', $path)[0];
    }
    
    public static function formatToRomanNumeral(string $gradeLevel): string {
        switch ($gradeLevel) {
            case 'Grade 7': return 'VII';
            case 'Grade 8': return 'VII';
            case 'Grade 9': return 'IX';
            case 'Grade 10': return 'X';
        }
        
        return 'Invalid Parameter';
    }
}