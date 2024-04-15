<?php
namespace App;
use Zems\Database;
class Model extends Database
{
    public function get()
    {
        echo "Model";
        return $this->connect();
    }
}
