<?php

declare(strict_types=1);

use app\Core\Application;
use app\Core\Request;
use app\Core\Response;
use app\Core\Router;
use app\Controllers\StudentController;
use app\Controllers\GradeController;
use app\Models\Student;
use app\Services\StudentService;
use app\Helpers\Format;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new Router(new Response, new Request), dirname(__DIR__));
$students = new StudentService($app->db->pdo, new Student);
$format = new Format();

$app->router->get('/', 'dashboard');

// for students' credential
$app->router->get('/students', 'StudentCredDashboard');

$app->router->get('/students/read', [StudentController::class, 'index']);    
$app->router->post('/students/read', [StudentController::class, 'index']);

$app->router->get('/students/create', [StudentController::class, 'createForm']);
$app->router->post('/students/create', [StudentController::class, 'create']);

$app->router->get('/students/delete', [StudentController::class, 'deleteForm']);
$app->router->post('/students/delete', [StudentController::class, 'delete']);

$app->router->get('/students/update', [StudentController::class, 'updateForm']);
$app->router->post('/students/update', [StudentController::class, 'update']);

// for students' grades manager
$app->router->get('/grades', 'StudentGradesDashboard');

$app->router->get('/grades/all', [GradeController::class, 'index']);    

$app->router->get('/grades/create', [GradeController::class, 'createForm']);
$app->router->post('/grades/create', [GradeController::class, 'create']);

$app->router->get('/grades/delete', [GradeController::class, 'deleteForm']);
$app->router->post('/grades/delete', [GradeController::class, 'delete']);

$app->router->get('/grades/update', [GradeController::class, 'updateForm']);
$app->router->post('/grades/update', [GradeController::class, 'update']);

$app->router->get('/grades/subject', [GradeController::class, 'createSubjectForm']);
$app->router->post('/grades/subject', [GradeController::class, 'createSubject']);

$app->run();

