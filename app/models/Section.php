<?php

declare(strict_types=1);

namespace app\Models;

use app\Core\Application;
use PDO;

class Section {

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function getAll() {
        $statement = $this->pdo->query("SELECT * FROM sections");
        return $statement->fetchAll();
    }

    public function getByGradeLevel(int $section, int $gradeLevel) {
        $statement = $this->pdo->prepare("SELECT * FROM sections
                                         WHERE grade_level_id = :gradeLevelID 
                                         ORDER BY id ASC
                                         LIMIT 1 OFFSET :offset"
                                         );
        $offset = $section - 1;
        $statement->execute([
            ':gradeLevelID' => $gradeLevel,
            ':offset' => $offset
        ]);
        
        return $statement->fetch();
    }
}