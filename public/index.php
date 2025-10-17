<?php

declare(strict_types=1);

use app\Core\Application;
use app\Core\Request;
use app\Core\Response;
use app\Core\Router;
use app\Controllers\StudentController;
use app\Models\Student;
use app\Services\StudentService;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new Router(new Response, new Request), dirname(__DIR__));
$students = new StudentService($app->db->pdo, new Student);

$app->router->get('/', 'dashboard');
$app->router->get('/students', [StudentController::class, 'index']);

$app->router->get('/students/create', [StudentController::class, 'createForm']);
$app->router->post('/students/create', [StudentController::class, 'create']);

$app->router->get('/students/delete', [StudentController::class, 'deleteForm']);
$app->router->post('/students/delete', [StudentController::class, 'delete']);

$app->run();

