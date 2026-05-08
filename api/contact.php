<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method not allowed');
}

header('Cache-Control: no-store');

$config = require dirname(__DIR__) . '/data/site.php';
require_once dirname(__DIR__) . '/data/database.php';
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

$stmt = db()->prepare(
    'INSERT INTO contact_messages (
        created_at, name, email, phone, project_type, location, message, ip_address, user_agent
    ) VALUES (
        :created_at, :name, :email, :phone, :project_type, :location, :message, :ip_address, :user_agent
    )'
);

$stmt->execute([
    'created_at' => $submission['date'],
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'project_type' => $projectType,
    'location' => $location,
    'message' => $message,
    'ip_address' => $submission['ip'],
    'user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
]);

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
