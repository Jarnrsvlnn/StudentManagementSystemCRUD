<?php 

declare(strict_types=1);

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Models\Student;
use app\Services\StudentService;
use app\Models\GradeLevel;
use app\Services\GradeLevelService;
use app\Models\Section;
use PDO;

class StudentController extends Controller {

    private PDO $pdo;
    private StudentService $studentService;
    private GradeLevelService $gradeLevelService;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
        $this->studentService = new StudentService($this->pdo, new Student);
        $this->gradeLevelService = new GradeLevelService($this->pdo, new GradeLevel);
    }

    public function getCategory(Request $request)
    {
        $data = $request->getData();
    }

    public function index(Request $request) 
    {
        $viewData = $request->getData();
        $viewCategory = $viewData['category'] ?? 'all-students';
        $students = $this->studentService->getAllStudents();
        $totalStudents = $this->studentService->getTotalStudents();

        switch ($viewCategory) {
            case "by-grade-level":
                $sortedStudents = $this->studentService->sortStudents($students);
                return $this->render('StudentCredentials', 'studentsPerGL', 
                [
                    'gradeLevels' => $sortedStudents,
                    'totalStudent' => $totalStudents
                ],
                'StudentViewLayout'
                );
            case "by-section":
                $sortedStudents = $this->studentService->sortStudents($students);
                return $this->render('StudentCredentials', 'studentsPerSection', 
                [
                    'gradeLevels' => $sortedStudents,
                    'totalStudent' => $totalStudents
                ],
                'StudentViewLayout'
                );
            default: 
                return $this->render('StudentCredentials', 'students', 
                [
                    'students' => $students,
                    'totalStudent' => $totalStudents
                ],
                'StudentViewLayout'
                );
        }
    }

    public function createForm() {
        $gradeLevels = $this->gradeLevelService->getAllGradeLevel();
        return $this->render('StudentCredentials', 'register', 
        [
            'gradeLevels' => $gradeLevels
        ]);
    }

    public function create(Request $request) {
        $studentData = $request->getData();
        $this->studentService->createStudent($studentData);
        return $this->render('StudentCredentials', 'register');
    }

    public function deleteForm() {
        $students = $this->studentService->getAllStudents();
        return $this->render('StudentCredentials', 'delete', 
        [
            'students' => $students
        ]);
    }

    public function delete(Request $request) {
        $studentData = $request->getData();
        $this->studentService->deleteStudent($studentData);
        $students = $this->studentService->getAllStudents();
        return $this->render('StudentCredentials', 'delete', 
        [
            'students' => $students
        ]);
    }

    public function updateForm() {
        $students = $this->studentService->getAllStudents();
        return $this->render('StudentCredentials', 'update', 
        [
            'students' => $students
        ]);
    }

    public function update(Request $request) {
        $studentData = $request->getData();
        $this->studentService->updateStudent($studentData);
        return $this->render('StudentCredentials', 'update', 
        [
            'students' => $this->studentService->getAllStudents()
        ]);
    }
}