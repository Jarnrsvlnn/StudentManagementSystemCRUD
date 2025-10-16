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

    public function getData(): array {
        $data = [];

        if ($this->getMethod() === 'get') {
            foreach($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'post') {
            foreach($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $data;
    }
}