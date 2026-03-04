<?php if (!defined('CORE_SECURED_INDONESIA')) exit; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/assets/css/portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body class="portal-body">

<div class="portal-wrapper">
    <div class="brand-section">
        <div class="brand-content">
            <div class="logo-placeholder">D</div>
            <h1>DIGITALIZATION</h1>
            <p>SECURED DIGITAL ECOSYSTEM</p>
            <div style="margin-top: 30px; font-size: 11px; color: #475569; border: 1px solid #1e293b; padding: 5px 15px; border-radius: 20px;">
                ENCRYPTED CONNECTION: <strong>ACTIVE</strong>
            </div>
        </div>
    </div>

    <div class="login-section">
        <div class="login-box">
            <h2 style="font-weight: 800;">Otentikasi Personel</h2>
            <p>Silakan masukkan kunci akses Digitalization Anda.</p>

            <?php if (isset($error)): ?>
                <div style="background:#fff1f2; color:#be123c; padding:12px; border-radius:8px; margin-bottom:25px; font-size:13px; border:1px solid #fecdd3; text-align:center;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="/login/submit" method="POST">
                <div class="form-group">
                    <label>ID PENGGUNA</label>
                    <input type="text" name="username" class="form-control" placeholder="admin_core" required autofocus>
                </div>
                <div class="form-group">
                    <label>KATA SANDI</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-submit">BUKA AKSES SISTEM</button>
            </form>

            <div style="margin-top: 30px; text-align: center;">
                <a href="/" style="font-size: 12px; color: #64748b; text-decoration: none;">&larr; Kembali ke Landing Page</a>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/portal.js"></script>
