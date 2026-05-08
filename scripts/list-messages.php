<?php

declare(strict_types=1);

require dirname(__DIR__) . '/data/database.php';

$rows = db()
    ->query('SELECT id, created_at, name, email, message FROM contact_messages ORDER BY id DESC LIMIT 20')
    ->fetchAll();

echo 'Database: ' . (getenv('DATABASE_PATH') ?: storage_path('database.sqlite')) . PHP_EOL;
echo 'Messages: ' . count($rows) . PHP_EOL;

foreach ($rows as $row) {
    echo sprintf(
        "#%d | %s | %s <%s> | %s\n",
        $row['id'],
        $row['created_at'],
        $row['name'],
        $row['email'],
        str_replace(["\r", "\n"], ' ', $row['message'])
    );
}
