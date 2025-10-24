<?php 

declare(strict_types=1);

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Services\StudentService;
use app\Services\GradeService;
use app\Models\Grade;
use app\Models\Subject;
use app\Services\SubjectService;
use PDO;

class GradeController extends Controller {

    private PDO $pdo;
    private GradeService $gradeService;
    private SubjectService $subjectService;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
        $this->gradeService = new GradeService($this->pdo, new Grade);
        $this->subjectService = new SubjectService($this->pdo, new Subject);
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