<?php

declare(strict_types=1);

require_once __DIR__ . '/env.php';

function start_admin_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name('dreambouw_admin');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
    session_start();
}

function admin_password_hash(): string
{
    return trim((string) (getenv('ADMIN_PASSWORD_HASH') ?: ''));
}

function admin_is_configured(): bool
{
    return admin_password_hash() !== '';
}

function admin_is_logged_in(): bool
{
    start_admin_session();
    return !empty($_SESSION['admin_logged_in']);
}

function require_admin(): void
{
    if (admin_is_logged_in()) {
        return;
    }

    header('Location: /admin/login.php', true, 303);
    exit;
}

function verify_admin_password(string $password): bool
{
    $hash = admin_password_hash();
    return $hash !== '' && password_verify($password, $hash);
}
