<?php 

declare(strict_types=1);

namespace app\Core;

use Dotenv\Dotenv;

class Application {
    public static Application $app;
    public static $ROOT_DIR;
    public Database $db;

    public function __construct(
        public Router $router,
        public string $rootPath
    )
    {
       self::$app = $this;
       self::$ROOT_DIR = $rootPath;

       $dotenv = Dotenv::createImmutable($rootPath);
       $dotenv->load();

       $this->db = new Database([
        'host' => $_ENV['DB_HOST'],
        'dbname' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS']
       ]);
    }

    public function run() {
        echo $this->router->resolve();
    }
}