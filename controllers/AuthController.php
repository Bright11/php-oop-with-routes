<?php

require_once __DIR__ . '/../core/BaseController.php';

require_once __DIR__ . '/../models/Auth.php';
// 

class AuthController extends BaseController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = new Auth();
    }

    public function showLogin()
    {
        $this->view('auth/login');
    }

    public function login()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('?action=loginForm');
        }
        $user = $this->authModel->findUserByUsername($username);


        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            // $_SESSION['user'] = [
            //     'id' => $user['id'],
            //     'email' => $user['email'],
            //     'name' => $user['name'],
            // ];
            $this->redirect('?action=index');
        } else {
            $_SESSION['error'] = 'Invalid username or password.';
            $this->redirect('?action=loginForm');
        }
    }

    public function showRegister()
    {
        $this->view('auth/register');
    }

    public function register()
    {

        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        if (empty($username) || empty($password) || empty($confirm) || empty($email)) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('?action=registerForm');
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            $this->redirect('?action=registerForm');
        }

        if ($this->authModel->findUserByUsername($username)) {
            $_SESSION['error'] = 'Username already exists.';
            $this->redirect('?action=registerForm');
        }

        $this->authModel->createUser($username, $password, $email);

        $_SESSION['user'] = $username;
        $this->redirect('?action=index');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('?action=loginForm');
    }
}
