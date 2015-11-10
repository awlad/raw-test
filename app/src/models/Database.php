<?php namespace Module\models;
/**
 * @author awlad
 * Class Database
 * @package Module\Core
 */

abstract class Database {
    public $conn;

    public function __construct() {
        try{
            $dbConfig = require_once ROOT_DIR . 'config/db.config.php';
            $this->conn = new \PDO('mysql:dbname='. $dbConfig['DB_NAME'].';host='. $dbConfig['DB_HOST'], $dbConfig['DB_USER'], $dbConfig['DB_PASS']);
            $this->conn->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
            $this->conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(\PDOException $e) {
            return 'Connection failed:' . $e->getMessage();
        }
    }
}
