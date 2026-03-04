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
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }

    public static function check() {
        // Jika tidak ada session, lempar ke /login (BUKAN /auth)
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
    }

    public static function logout() {
        session_destroy();
        header("Location: /login");
        exit;
    }
}
