<?php
namespace App\Auth\Controllers;

use App\Controller;
use App\Auth\Models\User;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('Auth/view/register');
    }

    public function register()
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'password' => password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT),
            'status' => 1
        ];

        if (empty($data['name']) || empty($data['email']) || empty($_POST['password'])) {
            header('Location: /register?error=1');
            exit;
        }

        $existing = User::where('email', $data['email'])->first();
        if ($existing) {
            header('Location: /register?error=2');
            exit;
        }

        User::create($data);
        header('Location: /login?success=1');
        exit;
    }

    public function showLogin()
    {
        return view('Auth/view/login');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            header('Location: /login?error=1');
            exit;
        }

        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: /');
            exit;
        }

        header('Location: /login?error=1');
        exit;
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}