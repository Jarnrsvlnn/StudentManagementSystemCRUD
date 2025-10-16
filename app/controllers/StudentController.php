<?php 

declare(strict_types=1);

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Models\Student;
use app\Services\StudentService;

class StudentController extends Controller {

    public function index() 
    {
        $db = Application::$app->db->pdo;
        $studentService = new StudentService($db, new Student);
        $students = $studentService->getAllStudents();

        return $this->render('students', ['students' => $students]);
    }

    public function createForm() {
        return $this->render('register');
    }

    public function create(Request $request) {
        $studentData = $request->getData();

        echo '<pre>';
        var_dump($studentData);
        echo '</pre>';

        return 'Send to the model';
    }
}