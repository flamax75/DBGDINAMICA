<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/data/auth.php';
require_once dirname(__DIR__) . '/data/database.php';

require_admin();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? '');
    $id = (int) ($_POST['id'] ?? 0);

    if ($action === 'mark_read' && $id > 0) {
        $stmt = $pdo->prepare('UPDATE contact_messages SET is_read = 1 WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    if ($action === 'delete' && $id > 0) {
        $stmt = $pdo->prepare('DELETE FROM contact_messages WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    if ($action === 'delete_all') {
        $pdo->exec('DELETE FROM contact_messages');
    }

    header('Location: /admin/', true, 303);
    exit;
}

$messages = $pdo
    ->query('SELECT * FROM contact_messages ORDER BY datetime(created_at) DESC, id DESC')
    ->fetchAll();

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Contact Messages - DreamBouw Group</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body class="admin-page">
    <main class="admin-shell">
        <header class="admin-header">
            <div>
                <h1>Contact Messages</h1>
                <p><?= count($messages) ?> message<?= count($messages) === 1 ? '' : 's' ?></p>
            </div>
            <div class="contact-actions">
                <a class="button button-secondary" href="/">Site</a>
                <?php if ($messages !== []): ?>
                    <form method="post" onsubmit="return confirm('Delete all messages?');">
                        <input type="hidden" name="action" value="delete_all">
                        <button class="button button-secondary button-danger" type="submit">Delete all</button>
                    </form>
                <?php endif; ?>
                <a class="button button-primary" href="/admin/logout.php">Logout</a>
            </div>
        </header>

        <?php if ($messages === []): ?>
            <p class="form-status">No messages yet.</p>
        <?php else: ?>
            <div class="admin-messages">
                <?php foreach ($messages as $message): ?>
                    <article class="admin-message <?= (int) $message['is_read'] === 1 ? 'is-read' : '' ?>">
                        <header>
                            <div>
                                <h2><?= h($message['name']) ?></h2>
                                <p><?= h($message['created_at']) ?></p>
                            </div>
                            <div class="admin-message-actions">
                            <?php if ((int) $message['is_read'] !== 1): ?>
                                <form method="post">
                                    <input type="hidden" name="action" value="mark_read">
                                    <input type="hidden" name="id" value="<?= (int) $message['id'] ?>">
                                    <button class="button button-secondary" type="submit">Mark read</button>
                                </form>
                            <?php endif; ?>
                                <form method="post" onsubmit="return confirm('Delete this message?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= (int) $message['id'] ?>">
                                    <button class="button button-secondary button-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </header>

                        <dl>
                            <div>
                                <dt>Email</dt>
                                <dd><a href="mailto:<?= h($message['email']) ?>"><?= h($message['email']) ?></a></dd>
                            </div>
                            <div>
                                <dt>Phone</dt>
                                <dd><?= h($message['phone']) ?></dd>
                            </div>
                            <div>
                                <dt>Project</dt>
                                <dd><?= h($message['project_type']) ?></dd>
                            </div>
                            <div>
                                <dt>Location</dt>
                                <dd><?= h($message['location']) ?></dd>
                            </div>
                        </dl>

                        <p class="admin-message-body"><?= nl2br(h($message['message'])) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>

</html>
