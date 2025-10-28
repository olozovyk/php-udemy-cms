<?php

namespace App\Admin\Controller;

use App\Admin\Support\AuthService;

class LoginController extends AbstractAdminController
{
    public function __construct(AuthService $authService)
    {
        parent::__construct($authService);
    }

    public function login(): void
    {
        if($this->authService->isLoggedIn()) {
            header('Location: public/index.php?route=admin/pages');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (empty($_POST['username']) || empty($_POST['password']))) {
            $errors[] = 'Fill in all the fields.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!empty($_POST['username']) && !empty($_POST['password']))) {
            $username = @(string)$_POST['username'];
            $password = @(string)$_POST['password'];
            $userVerified = $this->authService->handleLogin(username: $username, password: $password);

            if (!$userVerified) {
                $errors[] = 'Username or password is incorrect.';
            } else {
                header('Location: public/index.php?route=admin/pages');
                exit;
            }

        }

        $this->render('login/login', [
            'errors' => $errors,
        ]);
    }

    public function logout(): void
    {
        $this->authService->logout();
        header('Location: index.php?route=admin/pages');
    }
}
