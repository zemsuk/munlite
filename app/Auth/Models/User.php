<?php
namespace App\Auth\Models;

use App\Model;
use Zems\Database;

class User extends Model
{
    protected $table = 'user';

    public $name;
    public $email;

    public function __construct($name = false, $email = false)
    {
        parent::__construct();
        $this->name = $name;
        $this->email = $email;
    }
}