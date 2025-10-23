<?php

declare(strict_types=1);

namespace app\Services;

use app\Models\Subject;
use PDO;

class SubjectService {

    public function __construct(
        private PDO $db,
        private Subject $subjectModel
    )
    {}

    public function viewAllSubjects()
    {
        return $this->subjectModel->all();
    }

    public function findByCode(string $value)
    {
        return $this->subjectModel->find('subject_code', $value);
    }

    public function findByName(string $value)
    {
        return $this->subjectModel->find('subject_name', $value);
    }

    public function createSubject(string $subjectName, string $subjectCode) 
    {
        if ($this->findByCode($subjectCode)) {
            return 'Subject with that subject code already exists!';
        }

        if ($this->findByName($subjectName)) {
            return 'Subject with that subject name already exists';
        }

        $this->subjectModel->create($subjectName, $subjectCode);
    }

    public function updateSubject(string $subjectCode, string $subjectName)
    {
        if (!$this->findByCode($subjectCode)) {
            return "Subject with that subject code couldn't be found.";
        }

        if (!$this->findByName($subjectName)) {
            return "Subject with that subject name couldn't be found.";
        }

        $this->subjectModel->update($subjectCode, $subjectName);
    }

    public function deleteSubject(string $subjectCode)
    {
        if (!$this->findByCode($subjectCode)) {
            return "Subject with that subject code couldn't be found.";
        }

        $this->subjectModel->delete($subjectCode);
    }
}