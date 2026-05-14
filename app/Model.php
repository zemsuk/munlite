<?php
namespace App;
use Zems\BaseModel;
class Model extends BaseModel
{
    protected static $table;
    protected static $pk = 'id';

    // public static function get()
    // {
    //     $table = static::$table ?: strtolower(basename(str_replace('\\', '/', static::class)));
    //     $db = self::getInstance();
    //     $stmt = $db->conn->prepare("SELECT * FROM $table");
    //     $stmt->execute();
    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }

    // public static function find($id)
    // {
    //     $table = static::$table ?: strtolower(basename(str_replace('\\', '/', static::class)));
    //     $db = self::getInstance();
    //     $stmt = $db->conn->prepare("SELECT * FROM $table WHERE id = ?");
    //     $stmt->execute([$id]);
    //     return $stmt->fetch(\PDO::FETCH_ASSOC);
    // }
}