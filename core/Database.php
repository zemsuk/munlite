<?php
namespace Zems;
use PDO;
class Database
{
    public $conn = '';
    public $host = DB_HOST;
    public $user = DB_USERNAME;
    public $pass = DB_PASSWORD;
    public $database = DB_DATABASE;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully!!";
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function save()
    {
        echo "Save!!";
    }


    public static function lastId()
    {
        return self::lastInsertId();
    }

}
