<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method not allowed');
}

$config = require dirname(__DIR__) . '/data/site.php';
$site = $config['site'];

function field(string $name, int $maxLength): string
{
    $value = trim((string) ($_POST[$name] ?? ''));
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value);
    return substr($value, 0, $maxLength);
}

$name = field('name', 120);
$email = field('email', 180);
$phone = field('phone', 80);
$projectType = field('project_type', 120);
$location = field('location', 120);
$message = field('message', 3000);
$honeypot = field('company', 120);

if ($honeypot !== '') {
    header('Location: /?contact=sent#contact', true, 303);
    exit;
}

if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /?contact=error#contact', true, 303);
    exit;
}

$submission = [
    'date' => gmdate('c'),
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'project_type' => $projectType,
    'location' => $location,
    'message' => $message,
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
];

$storageDir = dirname(__DIR__) . '/storage';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0775, true);
}

file_put_contents(
    $storageDir . '/contact-submissions.log',
    json_encode($submission, JSON_UNESCAPED_SLASHES) . PHP_EOL,
    FILE_APPEND | LOCK_EX
);

$subject = 'Project request - DreamBouw Group';
$body = implode("\n", [
    "Name: {$name}",
    "Email: {$email}",
    "Phone: {$phone}",
    "Project type: {$projectType}",
    "Location: {$location}",
    '',
    $message,
]);

$headers = [
    'From: DreamBouw Website <no-reply@dreambouwgroup.com>',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
];

@mail($site['email'], $subject, $body, implode("\r\n", $headers));

header('Location: /?contact=sent#contact', true, 303);
