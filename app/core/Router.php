<?php 

declare(strict_types=1);

namespace App\Core;

class Router {
    protected array $routes = [];

    public function __construct(
        private Response $response,
        private Request $request
    )
    {}

    public function get(string $path, string|array|callable $callback): void {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, string|array|callable $callback): void {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$method] ?? '/';

        if (! $callback) {
            $this->response->setStatusCode(404);
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $instance = new ($callback[0])();
            $callback[0] = $instance;

            return call_user_func($callback);
        }

        return call_user_func($callback);
    }

    public function renderView(string $view) {
        $layoutContent = $this->renderLayout();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderLayout() {
        ob_start();
        include Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view) {
        ob_start();
        include Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}