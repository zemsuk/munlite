<?php
namespace Zems;
use PDO;
class Database
{
    public $conn = '';
    public $host = '127.0.0.1';
    public $user = 'root';
    public $pass = '';
    public $database = 'dena_pawna';
    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=dena_pawna", 'root', '');
            // set the PDO error mode to exception
            // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(e) {
            echo "Connection failed: " ;//. $e->getMessage();
        }
    }
  
}

$tconn = new \PDO("mysql:host=localhost;dbname=dena_pawna;charset=UTF8", 'root', '');