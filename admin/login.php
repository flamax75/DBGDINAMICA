<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/data/auth.php';

start_admin_session();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

if (admin_is_logged_in()) {
    header('Location: /admin/', true, 303);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = (string) ($_POST['password'] ?? '');

    if (!admin_is_configured()) {
        $error = 'Admin password is not configured.';
    } elseif (verify_admin_password($password)) {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/', true, 303);
        exit;
    } else {
        $error = 'Invalid password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login - DreamBouw Group</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body class="admin-page">
    <main class="admin-shell admin-login">
        <h1>Admin</h1>
        <p>Enter the admin password to view contact messages.</p>

        <?php if (!admin_is_configured()): ?>
            <p class="form-status form-status-error">Set ADMIN_PASSWORD_HASH in .env before using the admin panel.</p>
        <?php elseif ($error !== ''): ?>
            <p class="form-status form-status-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form class="contact-form" method="post">
            <div class="form-grid">
                <label class="form-span">
                    Password
                    <input type="password" name="password" autocomplete="current-password" required autofocus>
                </label>
            </div>
            <div class="contact-actions">
                <button class="button button-primary" type="submit">Log in</button>
                <a class="button button-secondary" href="/">Back to site</a>
            </div>
        </form>
    </main>
</body>

</html>
