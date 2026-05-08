<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/data/auth.php';
require_once dirname(__DIR__) . '/data/database.php';

require_admin();

header('Content-Type: text/plain; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

echo 'Database: ' . (getenv('DATABASE_PATH') ?: storage_path('database.sqlite')) . PHP_EOL;
echo 'Messages: ' . db()->query('SELECT count(*) FROM contact_messages')->fetchColumn() . PHP_EOL;
