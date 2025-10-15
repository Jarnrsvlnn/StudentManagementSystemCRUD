<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class StudentController extends Controller{
    
    private StudentService $studentService;

    public function __construct($db)
    {
        $studentModel = new Student($db);
        $this->studentService = new StudentService($db, $studentModel);
    }

    public function index() {

        $students = $this->studentService->getAllStudents();
        return $this->render($);
    }
}