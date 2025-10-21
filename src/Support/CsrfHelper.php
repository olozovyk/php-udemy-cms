<?php

namespace App\Support;

class CsrfHelper
{
    public function handle(): void
    {
        if (empty($_SESSION)) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                (empty($_POST['_csrf']) || empty($_SESSION['csrf_token'])) ||
                ($_POST['_csrf'] !== $_SESSION['csrf_token'])
            ) {
                http_response_code(403);
                echo 'CSRF token error.';
                exit;
            }

            unset($_SESSION['csrf_token']);
            $this->generateCsrf();
        }
    }

    public function generateCsrf(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));;
        }

        return $_SESSION['csrf_token'];
    }
}