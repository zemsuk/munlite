<?php

namespace App\dashboard;

use App\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $this->view('dashboard/views/dashboard');
    }
}