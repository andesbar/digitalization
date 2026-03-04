<?php if (!defined('CORE_SECURED_INDONESIA')) exit; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h1 style="margin: 0; color: #1a2a6c;">Ringkasan Nasional</h1>
        <p style="color: #666;">Selamat datang kembali, <strong><?php echo htmlspecialchars($admin); ?></strong>.</p>
    </div>
    <a href="/login/logout" style="padding: 10px 20px; background: #c53030; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">KELUAR SISTEM</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #1a2a6c;">
        <h3 style="margin: 0; color: #888; font-size: 14px; text-transform: uppercase;">Total Wilayah Terintegrasi</h3>
        <p style="font-size: 32px; font-weight: bold; margin: 10px 0; color: #1a2a6c;"><?php echo $total_wilayah; ?></p>
        <span style="color: #2f855a; font-size: 12px;">● Sistem Online</span>
    </div>

    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #2f855a;">
        <h3 style="margin: 0; color: #888; font-size: 14px; text-transform: uppercase;">Status Infrastruktur</h3>
        <p style="font-size: 20px; font-weight: bold; margin: 10px 0; color: #2f855a;">TERAMANKAN</p>
        <span style="color: #888; font-size: 12px;">Enkripsi SSL & AES-256 Aktif</span>
    </div>

    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #ed8936;">
        <h3 style="margin: 0; color: #888; font-size: 14px; text-transform: uppercase;">Waktu Sistem</h3>
        <p style="font-size: 20px; font-weight: bold; margin: 10px 0; color: #333;"><?php echo date('H:i'); ?> WIB</p>
        <span style="color: #888; font-size: 12px;"><?php echo date('d M Y'); ?></span>
    </div>
</div>

<div style="margin-top: 30px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <h3 style="margin-top: 0; color: #1a2a6c; border-bottom: 1px solid #eee; padding-bottom: 10px;">Akses Cepat Modul</h3>
    <div style="display: flex; gap: 10px; margin-top: 15px;">
        <button style="padding: 10px 15px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 5px; cursor: pointer;">Manajemen User</button>
        <button style="padding: 10px 15px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 5px; cursor: pointer;">Konfigurasi Wilayah</button>
        <button style="padding: 10px 15px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 5px; cursor: pointer;">Audit Log</button>
    </div>
</div>
