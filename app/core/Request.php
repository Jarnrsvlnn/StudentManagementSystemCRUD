<?php 

declare(strict_types=1);

namespace app\Core;

use app\Helpers\Format;

class Request {
    public function getPath() {
        return Format::formatPath($_SERVER['REQUEST_URI']);
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}