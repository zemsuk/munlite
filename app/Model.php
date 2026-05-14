<?php
namespace App;
use Zems\Database;
class Model extends Database
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $table = $this->table ?: strtolower(basename(str_replace('\\', '/', static::class)));

        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $table = $this->table ?: strtolower(basename(str_replace('\\', '/', static::class)));
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
