<?php 

declare(strict_types=1);

namespace app\Core;

class Controller {
    public function render(string $view, array $params = [], string $subLayout = 'BaseLayout') {
        return Application::$app->router->renderView($view, $params, $subLayout);
    }
}