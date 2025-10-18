<?php 

declare(strict_types=1);

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Models\Student;
use app\Services\StudentService;
use PDO;

class StudentController extends Controller {

    private PDO $pdo;
    private StudentService $studentService;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
        $this->studentService = new StudentService($this->pdo, new Student);
    }

    public function index() 
    {
        $students = $this->studentService->getAllStudents();
        return $this->render('students', ['students' => $students]);
    }

    public function createForm() {
        return $this->render('register');
    }

    public function create(Request $request) {
        $studentData = $request->getData();
        $this->studentService->createStudent($studentData);
        return $this->render('register');
    }

    public function deleteForm() {
        $students = $this->studentService->getAllStudents();
        return $this->render('delete', ['students' => $students]);
    }

    public function delete(Request $request) {
        
        $studentData = $request->getData();
        $this->studentService->deleteStudent($studentData);
        return $this->render('delete');
    }

    public function updateForm() {
        $students = $this->studentService->getAllStudents();
        return $this->render('update', ['students' => $students]);
    }

    public function update(Request $request) {
        $studentData = $request->getData();
        $this->studentService->updateStudent($studentData);
        return $this->render('update', ['students' => $this->studentService->getAllStudents()]);
    }
}