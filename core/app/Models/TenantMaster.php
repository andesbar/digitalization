<?php
namespace App\Models;

use App\Core\Database;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class TenantMaster {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getTenantBySubdomain($sub) {
        $stmt = $this->db->prepare("SELECT * FROM public.master_tenants WHERE subdomain = :s AND is_active = true LIMIT 1");
        $stmt->execute(['s' => $sub]);
        return $stmt->fetch();
    }
}
