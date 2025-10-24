<?php 

declare(strict_types=1);

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Services\StudentService;
use app\Services\GradeService;
use app\Models\Grade;
use app\Models\Student;
use app\Models\Subject;
use app\Services\SubjectService;
use PDO;

class GradeController extends Controller {

    private PDO $pdo;
    private GradeService $gradeService;
    private SubjectService $subjectService;
    private StudentService $studentService;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
        $this->gradeService = new GradeService($this->pdo, new Grade);
        $this->subjectService = new SubjectService($this->pdo, new Subject);
        $this->studentService = new StudentService($this->pdo, new Student);
    }

    public function index() 
    {
        $grades = $this->gradeService->viewStudentGrades();
        return $this->render('StudentGrades', 'readGrades', ['grades' => $grades]);
    }
    
    public function createForm() 
    {
        $students = $this->studentService->getAllStudents();
        $subjects = $this->subjectService->getAllSubjects();

        return $this->render('StudentGrades', 'assignGrades', 
        [
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    public function create(Request $request) 
    {
        $students = $this->studentService->getAllStudents();
        $subjects = $this->subjectService->getAllSubjects();
        $gradeData = $request->getData();

        $subjectData = $this->subjectService->findByCode($gradeData['subject-code']);
        $subjectID = $subjectData['id'];

        $studentData = $this->studentService->findByStudentID($gradeData['student-id']);
        $studentID = $studentData['id'];

        $grade = (float) $gradeData['grade'];

        $this->gradeService->assignGrade($subjectID, $studentID, $grade);
        return $this->render('StudentGrades', 'assignGrades', 
        [
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    public function createSubjectForm()
    {
        return $this->render('StudentGrades', 'subjectForm');
    }

    public function createSubject(Request $request)
    {   
        $subjectData = $request->getData();
        $this->subjectService->createSubject($subjectData['subject-name'], $subjectData['subject-code']);
        return $this->render('StudentGrades', 'subjectForm');
    }
}