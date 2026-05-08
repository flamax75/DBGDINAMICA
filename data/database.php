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
