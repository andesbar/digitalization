<?php if (!defined('CORE_SECURED_INDONESIA')) exit; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DIGITALIZATION | Portal Nasional</title>
    <link rel="stylesheet" href="/assets/css/portal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="portal-wrapper" style="flex-direction: column; justify-content: center; align-items: center; height: 85vh;">
    <div class="logo-placeholder">D</div>
    <h1 style="font-size: 4rem; margin: 10px 0;">DIGITALIZATION</h1>
    <p style="letter-spacing: 8px; color: #64748b;">SECURED DIGITAL ECOSYSTEM</p>

    <button onclick="enterGate()" style="margin-top: 40px; padding: 15px 50px; border-radius: 50px; background: #0f172a; color: white; border: none; cursor: pointer; font-weight: bold; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
        AKSES SISTEM
    </button>
</div>

<script>
function enterGate() {
    Swal.fire({
        title: 'Konfirmasi Keamanan',
        text: "Anda mencoba mengakses DIGITALIZATION Core. Lanjutkan?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Lanjutkan',
        confirmButtonColor: '#0f172a'
    }).then((result) => { if (result.isConfirmed) window.location.href = '/login'; });
}
</script>
