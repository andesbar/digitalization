<?php
namespace App\Core;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class Auth {
    public static function login($username, $password) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM public.users WHERE username = :u LIMIT 1");
        $stmt->execute(['u' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }

    public static function check() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            // SINKRONISASI: Arahkan ke /login, bukan /auth
            header("Location: /login");
            exit;
        }
    }

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        // SINKRONISASI: Arahkan ke /login setelah keluar
        header("Location: /login");
        exit;
    }
}
