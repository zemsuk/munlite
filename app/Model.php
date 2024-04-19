<?php
namespace App;
use Zems\Database;
class Model extends Database
{
    public $my_model = null;
    public static $query = null;
    public static $column = null;
    public static $where = null;
    public static $join_query = null;
    public function __construct() {
        // $this->my_model = get_class($this);
    }
    public static function get_model_name(){
        $get_model = get_called_class();
        $get_model = explode('\\',$get_model);
        $get_model = end($get_model);
        $get_model = strtolower($get_model);
        return $get_model;
    }
    public static function all(){
        $model_name = self::get_model_name();
        $sql = "SELECT * FROM `$model_name`";
        // $db = new Database;
        $query = self::connect()->query($sql);
        $result = $query->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }
    public static function find($id = false)
    {
        $model_name = self::get_model_name();
        $select = null;
        if($select == null){
            $select = "*";
        }
        $result = self::connect()->query("SELECT $select FROM $model_name WHERE id=$id");
        
        $result = $result->fetch(\PDO::FETCH_OBJ);
        // return new static;
        return $result;
    }
    public static function select($sel){
        static::$column = $sel;
        return new static;
    }
    public static function where($field = false, $operator = false, $value = false){
        // static::$where = $data;
        
        if($operator == false && $value == false){
            $value = $field;
            $operator = "=";
            $field = "id";
        } else 
        if($value == false){
            $value = $operator;
            $operator = "=";
        }
        $field = "`$field`";
        $combine = $field.$operator.$value;
        // print($combine);
        static::$where = $combine;
        return new static;
    }
    public static function join($table, $pk, $fk){
        static::$join_query = [$table, $pk, $fk];
        return new static;
    }
    public static function get()
    {
        $model_name = self::get_model_name();
        $select = "*";
        if(static::$column != null){
            $select = static::$column;
        }
        $result = self::connect()->query("SELECT $select FROM $model_name");
        $result = $result->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }
    public static function result(){
        if(static::$query) {
            echo "Hello";
        }
        $output = [static::$column, static::$join_query];
        return $output;
    }
    public static function create($data){
        $model_name = self::get_model_name();
        $keys = array_keys($data);
        $fields = implode(', ', array_map(function($i) {return '`' . $i.'`';}, $keys));
        $placeholder = implode(', ', array_map(function($i) {return ':' . $i;}, $keys));
        $sql = "INSERT INTO `$model_name` ($fields) VALUES ($placeholder)";
        $query = self::connect()->prepare($sql);
        return $query->execute($data);
    }
    
    public static function update($data){
        $model_name = self::get_model_name();
        $keys = array_keys($data);
        $fields = implode(', ', array_map(function($i) {return '`' . $i.'` = :'.$i;}, $keys));
        $cls = self::$where;
        $cls = str_ireplace("`", "", $cls);
        $cls = explode("=", $cls);
        $wheredata = [
            $cls[0]=>$cls[1]
        ];
        $wfields = '`' . $cls[0].'` = :'.$cls[0];
        $upData = array_merge($data, $wheredata);
        $sql = "UPDATE `$model_name`   
        SET $fields
        WHERE $wfields";
        // $sql = "UPDATE `$model_name`   
        // SET `contact_first_name` = :firstname,
        //     `contact_surname` = :surname,
        //     `contact_email` = :email,
        //     `telephone` = :telephone 
        // WHERE `user_id` = :user_id";
        $query = self::connect()->prepare($sql);
        return $query->execute($upData);
    }
    public static function delete($field = false, $operator = false, $value = false){
        $model_name = self::get_model_name();
        if($operator == false && $value == false){
            $value = $field;
            $operator = "=";
            $field = "id";
        } else 
        if($value == false){
            $value = $operator;
            $operator = "=";
        }
        $field = "`$field`";
        
        $sql = "DELETE FROM $model_name WHERE $field = ?";
        $query = self::connect()->prepare($sql);
        return $query->execute([$value]);
    }
    public static function ddd($id){
        // self::$test=$id;
        echo "save";
        $model_name = self::get_model_name();
        $select = null;
        if($select == null){
            $select = "*";
        }
        $result = self::connect()->query("SELECT $select FROM $model_name WHERE id=$id");
        
        $result = $result->fetch(\PDO::FETCH_OBJ);
        self::$test = $result;
        return new static;
    }
}
