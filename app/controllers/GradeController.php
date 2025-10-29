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
        return $this->render('layouts', 'StudentGradesDashboard', ['grades' => $grades]);
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
        $data = $request->getData();

        // assign grade data first into the student_grades table
        $subjectID = (int) $data['subject-id'];
        $studentData = $this->studentService->findByStudentID($data['student-id']);
        $studentID = $studentData['id'];
        $this->gradeService->assignStudentGrade($subjectID, $studentID);

        // assigning quarter grades for each grade data from student_grades into quarter_grades table
        $studentGradeID = $this->gradeService->getStudentGradeID($subjectID, $studentID);
        $quarter = $data['quarter'];
        $grade = (float) $data['grade'];
        $this->gradeService->assignQuarterGrade($studentGradeID, $quarter, $grade);
        
        $this->gradeService->calculateFinalGrade($studentGradeID);
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