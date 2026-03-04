<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Auth;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class DashboardController extends BaseController {

    public function __construct() {
        parent::__construct();
        Auth::check(); // Penjagaan ketat
    }

    public function index() {
        // Karena kita tidak kirim parameter ketiga, maka header & footer otomatis dipanggil
        $this->view('dashboard', [
            'title' => 'Dashboard Utama',
            'user'  => $_SESSION['username']
        ]);
    }
}
