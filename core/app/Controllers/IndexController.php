<?php
namespace App\Controllers;

use App\Core\BaseController;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class IndexController extends BaseController {
    public function index() {
        // Render Landing Page: No Header, Yes Footer
        $this->view('index', ['title' => 'Portal Nasional ANDESBAR'], false, true);
    }
}
