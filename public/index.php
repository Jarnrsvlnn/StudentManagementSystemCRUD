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
$app->router->get('/student', 'StudentMenu');

// for students' credential

$app->router->get('/credential', [StudentController::class, 'index']);    
$app->router->post('/students/read', [StudentController::class, 'index']);

$app->router->get('/students/create', [StudentController::class, 'createForm']);
$app->router->post('/students/create', [StudentController::class, 'create']);

$app->router->get('/students/delete', [StudentController::class, 'deleteForm']);
$app->router->post('/students/delete', [StudentController::class, 'delete']);
    
$app->router->get('/students/update', [StudentController::class, 'updateForm']);
$app->router->post('/students/update', [StudentController::class, 'update']);

// for students' grades manager

$app->router->get('/grades', [GradeController::class, 'indexAvgGrade']);
$app->router->post('/grades/create', [GradeController::class, 'createGrade']);
$app->router->get('/grades/quarterly', [GradeController::class, 'indexQuarterlyGrade']);

$app->router->post('/grades/quarterly', [GradeController::class, 'updateQuarterGrade']);

$app->router->get('/grades/subject', [GradeController::class, 'createSubjectForm']);
$app->router->post('/grades/subject', [GradeController::class, 'createSubject']);

$app->run();

