<?php

declare(strict_types=1);

namespace app\Core;

use PDO;
use PDOException;

class Database {
    public PDO $pdo;

    public function __construct($config) 
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};";

        try 
        {
            $this->pdo = new PDO($dsn, $config['user'], $config['pass'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
}