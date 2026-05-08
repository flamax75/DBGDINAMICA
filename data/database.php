<?php

declare(strict_types=1);

require_once __DIR__ . '/env.php';

function storage_path(string $path = ''): string
{
    $base = dirname(__DIR__) . '/storage';
    if (!is_dir($base)) {
        mkdir($base, 0775, true);
    }

    return $path === '' ? $base : $base . '/' . ltrim($path, '/');
}

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    if (db_uses_mysql()) {
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '3306';
        $database = getenv('DB_DATABASE') ?: '';
        $username = getenv('DB_USERNAME') ?: '';
        $password = getenv('DB_PASSWORD') ?: '';
        $charset = getenv('DB_CHARSET') ?: 'utf8mb4';

        $pdo = new PDO(
            "mysql:host={$host};port={$port};dbname={$database};charset={$charset}",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        migrate($pdo);

        return $pdo;
    }

    $databasePath = getenv('DATABASE_PATH') ?: storage_path('database.sqlite');
    $databaseDir = dirname($databasePath);
    if (!is_dir($databaseDir)) {
        mkdir($databaseDir, 0775, true);
    }

    $pdo = new PDO('sqlite:' . $databasePath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON');
    $pdo->exec('PRAGMA journal_mode = WAL');
    migrate($pdo);

    return $pdo;
}

function migrate(PDO $pdo): void
{
    if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS contact_messages (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                created_at VARCHAR(40) NOT NULL,
                name VARCHAR(120) NOT NULL,
                email VARCHAR(180) NOT NULL,
                phone VARCHAR(80) NULL,
                project_type VARCHAR(120) NULL,
                location VARCHAR(120) NULL,
                message TEXT NOT NULL,
                ip_address VARCHAR(45) NULL,
                user_agent VARCHAR(500) NULL,
                is_read TINYINT(1) NOT NULL DEFAULT 0
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        return;
    }

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS contact_messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            created_at TEXT NOT NULL,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            phone TEXT,
            project_type TEXT,
            location TEXT,
            message TEXT NOT NULL,
            ip_address TEXT,
            user_agent TEXT,
            is_read INTEGER NOT NULL DEFAULT 0
        )'
    );
}

function db_description(): string
{
    if (db_uses_mysql()) {
        return sprintf(
            'mysql:%s/%s',
            getenv('DB_HOST') ?: 'localhost',
            getenv('DB_DATABASE') ?: ''
        );
    }

    return getenv('DATABASE_PATH') ?: storage_path('database.sqlite');
}

function db_uses_mysql(): bool
{
    $connection = getenv('DB_CONNECTION') ?: '';

    if ($connection !== '') {
        return $connection === 'mysql';
    }

    return (bool) (getenv('DB_HOST') || getenv('DB_DATABASE'));
}
