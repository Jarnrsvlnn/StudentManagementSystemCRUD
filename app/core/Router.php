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
            return;
        }

        if (is_string($callback)) {
            return $this->renderView('layouts', $callback);
        }

        if (is_array($callback)) {
            $controller = new ($callback[0])();
            $callback[0] = $controller;

            return call_user_func($callback, $this->request);
        }

        return call_user_func($callback);
    }

    public function renderView(string $tabGroup, string $view, array $params = [], string $subLayout = 'BaseLayout') {

        // main.php where the design for sidebar and dashboard resides
        $layoutContent = $this->renderRootLayout(); 

        /***
         * this renders the content to be put inside the root layout,
         * tabGroup = refers to the folder in which the view content resides (layouts, StudentCredentials, & StudentGrades)
         * view = refers to each individual content inside the said tab group which are to be put inside the sub layout (which is another layout on top of root layout)
         * params = informations in a form of an array that is passed to the views and is accessed using the views
         */
        $viewContent = $this->renderOnlyView($tabGroup, $view, $params); 

        // renders the sub layout which are nested inside the root layout (all layouts are using the BaseLayout as sub layout except for one which is StudentViewLayout which is used by students view)
        $subLayoutContent = $this->renderSubLayout($subLayout);

        // replaces the {{content}} inside sub layouts with view contents, giving the whole content to be passed to the root layout
        $finalViewContent = str_replace('{{content}}', $viewContent, $subLayoutContent);

        // finally replaces the {{content}} inside the root layout with the finalized view content
        return str_replace('{{content}}', $finalViewContent, $layoutContent); 
    }

    public function renderRootLayout(): string {
        ob_start();
        include Application::$ROOT_DIR . "/app/Views/layouts/RootLayout/main.php";
        return ob_get_clean();
    }

    public function renderSubLayout(string $subLayout): string {
        ob_start();
        include Application::$ROOT_DIR . "/app/Views/layouts/$subLayout.php";
        return ob_get_clean();
    }

    public function renderOnlyView($tabGroup, $view, $params): string {
        extract($params);
        ob_start();
        include Application::$ROOT_DIR . "/app/Views/$tabGroup/$view.php";
        return ob_get_clean();
    }
}