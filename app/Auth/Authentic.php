<?php
namespace App\Auth;

use App\Controller;

class Authentic extends Controller{
    public $is_loggedIn = false;
    public function __construct()
    {  
        // if(isset($_COOKIE['auth_id'])){
        //     $this->is_loggedIn = true;
        // } else {
        //     return $this->redirect('/');
        // }
    }
    public function logOut() {
        if(isset($_COOKIE['auth_id'])){
            setcookie("auth_id", "", time() - 3600, "/");
            setcookie("authentic", "", time() -3600, "/");
            return $this->redirect('/');
        }
    }

}