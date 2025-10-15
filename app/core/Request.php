<?php 

declare(strict_types=1);

namespace App\Core;

use App\helpers\Format;

class Request {
    public function getPath() {
        return Format::formatPath($_SERVER['REQUEST_URI']);
    }

    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }
}