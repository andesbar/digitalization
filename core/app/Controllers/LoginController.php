<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Auth;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class LoginController extends BaseController {

    public function index() {
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit;
        }

        $data = ['title' => 'Portal Nasional'];

        // PARAMETER: view($page, $data, $header, $footer)
        // Header = false (HILANG), Footer = true (ADA)
        $this->view('login', $data, false, true);
    }

    public function submit() {
        $user = trim($_POST['username'] ?? '');
        $pass = trim($_POST['password'] ?? '');

        if (Auth::login($user, $pass)) {
            header("Location: /dashboard");
            exit;
        } else {
            $this->view('login', ['title' => 'Gagal', 'error' => 'Akses Ditolak!'], false, true);
        }
    }
}
