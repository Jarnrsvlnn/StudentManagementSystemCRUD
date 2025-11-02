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
use app\Helpers\Format;
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

    public function indexAvgGrade() 
    {
        $grades = $this->gradeService->viewAvgGrades();
        Format::debugStructure($grades);
        $students = $this->studentService->getAllStudents();
        $subjects = $this->subjectService->getAllSubjects();

        return $this->render('layouts', 'StudentGradesDashboard', [
            'avgGrades' => $grades,
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    public function indexQuarterlyGrade(Request $request) 
    {
        $quarterGradesData = $request->getData();
        $studentID = (int) $quarterGradesData['student-id'];
        $quarterGrades = $this->gradeService->viewStudentQuarterGrades($studentID);

        Format::debugStructure($quarterGrades); 
        
        $students = $this->studentService->getAllStudents();
        $subjects = $this->subjectService->getAllSubjects();

        return $this->render('StudentGrades', 'QuarterlyGrade', [
            'quarterGrades' => $quarterGrades,
            'students' => $students,
            'subjects' => $subjects
        ]);
    }
    
    // public function createForm() 
    // {
    //     $students = $this->studentService->getAllStudents();
    //     $subjects = $this->subjectService->getAllSubjects();

    //     return $this->render('layouts', 'StudentGradesDashboard', 
    //     [
    //         'grades' => $grades,
    //         'students' => $students,
    //         'subjects' => $subjects
    //     ]);
    // }   

    // public function createGrade(Request $request) 
    // {
    //     $students = $this->studentService->getAllStudents();
    //     $subjects = $this->subjectService->getAllSubjects();
    //     $data = $request->getData();

    //     // assign grade data first into the student_grades table
    //     $subjectID = (int) $data['subject-id'];
    //     $studentData = $this->studentService->findByStudentID($data['student-id']);
    //     $studentID = $studentData['id'];
    //     $this->gradeService->assignStudentGrade($subjectID, $studentID);

    //     // assigning quarter grades for each grade data from student_grades into quarter_grades table
    //     $studentGradeID = $this->gradeService->getStudentGradeID($subjectID, $studentID);
    //     $quarter = $data['quarter'];
    //     $grade = (float) $data['grade'];
    //     $this->gradeService->assignQuarterGrade($studentGradeID, $quarter, $grade);
        
    //     $this->gradeService->calculateFinalGrade($studentGradeID);
    //     $this->gradeService->calculateAvgGrade($studentID);

    //     header("Location: grades");
    //     return $this->render('layouts', 'StudentGradesDashboard', 
    //     [
    //         'grades' => $grades,
    //         'students' => $students,
    //         'subjects' => $subjects
    //     ]);
    // }

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