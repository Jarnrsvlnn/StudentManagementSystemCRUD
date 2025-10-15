<?php

declare(strict_types=1);

use App\Core\Application;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Controllers\StudentController;

$app = new Application(new Router(new Response, new Request), dirname(__DIR__));

$app->router->get('/', function() { return 'Home Page'; });
$app->router->get('/students', [StudentController::class, 'index']);
$app->router->get('/students/create', [StudentController::class, 'create']);
$app->router->post('/students', [StudentController::class, 'store']);