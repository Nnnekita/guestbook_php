<?php
    require_once('config.php');
    var_dump($_POST);
    if ($_POST) {
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    if ($name && $message) {
        
        $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
        $stmt->execute([$name, $message]);

        
        header('Location: index.php');
        exit;
    } else {
        $error = "Пожалуйста, заполните все поля.";
    }
    }

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
</head>
<body>
<div class="box">
    <form method="POST">
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