<?php
namespace Zems;
use PDO;
// include('../config.php');
class Database extends Config
{
    // public $conn = '';
    // public $host = '127.0.0.1';
    // public $user = 'root';
    // public $pass = '';
    // public $database = 'zems_fitness_club';
    public function __construct(){
        // try {
        //     $this->conn = new PDO("mysql:host=".$this->host.";dbname=zems_fitness_club", 'root', '');
        //     // set the PDO error mode to exception
        //     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     // echo "Connected successfully";

        // } catch(e) {
        //     echo "Connection failed: " ;//. $e->getMessage();
        // }
    }
    public static function connect(){
        
        try {
            $con = new PDO("mysql:host=".HOST_NAME.";dbname=".HOST_DATABASE, HOST_USER, HOST_PASSWORD);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            
            return $con;

        } catch(e) {
            echo "Connection failed: " ;//. $e->getMessage();
        }
    }
    
    public static function lastId()  {
        return self::connect()->lastInsertId();
    }
  
}
