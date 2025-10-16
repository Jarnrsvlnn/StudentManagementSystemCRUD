<?php 

declare(strict_types=1);

namespace app\Core;

class Controller {
    public function render(string $view, array $params = []) {
        return Application::$app->router->renderView($view, $params);
    }
}