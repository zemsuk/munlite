<?php
namespace App\Auth\Model;
use App\Model;
class User extends Model {
    protected $test = "This is test";
    
    public function myModel(){
        $data = [
            'name','phone_number','email','country_id','password'
        ];
    }

} 