<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Models\Customer;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('Controllers/view/index');
    }
    public function about()
    {
        $cus = new Customer;
        var_dump($cus);
    }
    public function allUser()
    {
        $users = [
            new User('John Doe', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a6ccc9cec8e6c3dec7cbd6cac388c5c9cb">sfsd</a>'),
            new User('Jane Doe', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fe949f909bbe9b869f938e929bd09d9193">sf</a>')
        ];

        $this->view('Controllers/view/user/index', ['users' => $users, 'test'=>"Hello"]);
    }
}