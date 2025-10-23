<?php 

declare(strict_types=1);

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Services\StudentService;
use app\Services\GradeService;
use app\Models\Grade;
use PDO;

class StudentController extends Controller {

    private PDO $pdo;
    private GradeService $gradeService;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
        $this->gradeService = new GradeService($this->pdo, new Grade);
    }

}