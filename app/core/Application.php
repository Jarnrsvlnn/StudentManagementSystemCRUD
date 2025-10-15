<?php 

declare(strict_types=1);

namespace App\Core;

class Application {
    public static Application $app;
    public static $ROOT_DIR;

    public function __construct(
        public Router $router,
        public string $rootPath
    )
    {
       self::$app = $this;
       self::$ROOT_DIR = $rootPath;
    }

    public function run() {
        $this->router->resolve();
    }
}