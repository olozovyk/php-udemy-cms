<?php

namespace App\Admin\Support;

class AuthService
{
    public function __construct(private readonly \PDO $pdo)
    {

    }

    private function startSession(): void
    {
        if (!session_id()) {
            session_start();
        }
    }

    public function handleLogin(string $username, string $password): bool
    {
        if (empty($username) || empty(($password))) return false;

        $user = $this->fetchUser($username);
        if (!$user) return false;

        $userVerified = $this->verifyPassword($password, $user['password']);
        if (!$userVerified) return false;

        $this->startSession();
        $_SESSION['adminUserId'] = $user['id'];
        session_regenerate_id(true);

        return true;
    }

    public function logout(): void
    {
        $this->startSession();
        unset($_SESSION['adminUserId']);
        session_regenerate_id();
    }

    public function isLoggedIn(): bool
    {
        $this->startSession();
        return !empty($_SESSION['adminUserId']);
    }

    public function ensureLoggedIn(): void
    {
        $isLoggedIn = $this->isLoggedIn();
        if (!$isLoggedIn) {
            header('Location: index.php?route=admin/login');
            exit;
        }
    }

    private function fetchUser(string $username)
    {
        $stmt = $this->pdo->prepare('SELECT id, password FROM users WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}