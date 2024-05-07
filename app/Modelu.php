<?php
namespace App;
use Zems\Database;
class Model extends Database
{
    public $my_model = null;
    public static $read = null;
    public static $column = null;
    public static $where = null;
    public static $join_query = null;
    public static $original_model = null;
    public static $original_operator = null;
    public function __construct() {
        // $this->my_model = get_class($this);
    }
    public static function get_model_name(){
        $get_model = get_called_class();
        $get_name = new $get_model;
        self::$original_model = $get_name;
        if(isset($get_name->table_name)){
            return $get_name->table_name;
        }
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
    public static function find($field = false, $operator = false, $value = false)
    {
        $model_name = self::get_model_name();
        $select = null;
        if($select == null){
            $select = "*";
        }
        if($operator == false && $value == false){
            $value = $field;
            $operator = "=";
            $field = "id";
        } else 
        if($value == false){
            $value = $operator;
            $operator = "=";
        }
        // $field = "`$field`";
        $combine = $field.$operator.$value;
        $sql = "SELECT $select FROM $model_name ";

        if(static::$join_query != null){
            $join = self::$join_query;
            foreach($join as $j){
                $sql .="JOIN $j[0] on $j[1] = $j[2] ";
            }
        }
        if(static::$where != null){
            $whereClause = self::$where;
            $whereClause = implode(' AND ', array_map(function($i) {return $i[0];}, $whereClause));
            $whereClause = $whereClause. " AND ".$combine;
            $sql .= "WHERE ".$whereClause." ";
        } else {
            $sql .= "WHERE $combine ";
        }
        $result = self::connect()->query($sql);

        $result = $result->fetch(\PDO::FETCH_OBJ);
        // return new static;
        return $result;
    }
    public static function sql($sql){
        // static::$column = $sel;
        return self::result($sql);
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
        // $field = "`$field`";
        $combine = $field.$operator.$value;
        // print($combine);
        static::$where[] = [...[$combine]];
        return new static;
    }
    public static function join($table, $pk, $fk){
        static::$join_query[] = [...[$table, $pk, $fk]];
        return new static;
    }
    public static function get()
    {
        $model_name = self::get_model_name();
        $select = "*";
        if(static::$column != null){
            $select = static::$column;
        }
        $sql = "SELECT $select FROM $model_name ";
        if(static::$join_query != null){
            $join = self::$join_query;
            foreach($join as $j){
                $sql .="JOIN $j[0] on $j[1] = $j[2] ";
            }
        }
        if(static::$where != null){
            $whereClause = self::$where;
            $whereClause = implode(' AND ', array_map(function($i) {return $i[0];}, $whereClause));
            $sql .= "WHERE ".$whereClause." ";
        }
        return self::result($sql);
    }
    public static function result($sql){
        $result = self::connect()->query($sql);
        $result = $result->fetchAll(\PDO::FETCH_OBJ);
        return $result;
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
        $delimiters = ['=', '>', '<'];
        $wfields = null;
        $wheredata = [];
        foreach($cls as $c){
            $wc = str_replace($delimiters, '=', $c[0]);

            $cls = explode("=", $wc);
            if($wfields == null){
                $wfields = '`' . $cls[0].'` = :'.$cls[0];
            } else {
                $wfields = $wfields . ' AND `' . $cls[0].'` = :'.$cls[0];
            }
            $wheredata[$cls[0]] = $cls[1];
            
        }
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
    public static function lastId(){
        $model_name = self::get_model_name();
        $pk = 'id';
        $get_pk = self::$original_model;
        if(isset($get_pk->primary_key)){
            $pk = $get_pk->primary_key;
        }
        $sql = "SELECT $pk FROM $model_name ORDER BY $pk DESC LIMIT 1";
        
        $result = self::connect()->query($sql);
        $result = $result->fetch(\PDO::FETCH_OBJ);
        return $result->$pk;
    }
}
