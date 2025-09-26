<?php
    require_once('config.php');
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="box container col-6">
    <form method="POST" action = "add.php">
        <input type="text" name="name" placeholder="Your name" required>
        <textarea name="message" rows="4" placeholder="Your message" required></textarea>
        <button type="submit">Send</button>
    </form>

    <h3>Сообщение <?= count($messages) ?></h3>

    <?php if (empty($messages)): ?>
        <p>Будьте первым!</p>
    <?php else:?>
        <?php foreach ($messages as $msg): ?>
            <div class="message">
                <div class="name">
                    <?= htmlspecialchars($msg['name']) ?>
                </div>
                <div class="date">
                    <?= $msg['created_at'] ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>