<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;

class UserController extends Controller {
    public function index() {
        $users = [
            new User('John Doe', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a6ccc9cec8e6c3dec7cbd6cac388c5c9cb">[email&nbsp;protected]</a>'),
            new User('Jane Doe', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fe949f909bbe9b869f938e929bd09d9193">[email&nbsp;protected]</a>')
        ];

        $this->view('Controllers/user/index', ['users' => $users]);
    }
}