<?php 

declare(strict_types=1);

namespace app\Core;

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
        $callback = $this->routes[$method][$path] ?? false;

        if (! $callback) {
            $this->response->setStatusCode(404);
            echo '404 Server Not Found';
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

    public function renderView(string $view, array $params = []) {
        $layoutContent = $this->renderLayout();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent); 
    }

    public function renderLayout(): string {
        ob_start();
        include Application::$ROOT_DIR . "/app/Views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params): string {
        extract($params);
        
        ob_start();
        include Application::$ROOT_DIR . "/app/Views/$view.php";
        return ob_get_clean();
    }
}