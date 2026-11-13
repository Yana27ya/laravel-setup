<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вітаємо — Лабораторна №6</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; display: flex; justify-content: center; padding-top: 60px; }
        .card { background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 420px; text-align: center; }
        h2 { color: #28a745; margin-top: 0; }
        p { color: #444; font-size: 15px; }
        .logout-btn { display: inline-block; margin-top: 15px; padding: 9px 20px; background: #dc3545; color: #fff; text-decoration: none; border-radius: 4px; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>
<div class="card">
    <h2>Вітаємо, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <p>Ви успішно авторизувалися та перейшли на захищену сторінку <strong>Welcome.php</strong>.</p>
    <p>Ваша електронна пошта: <strong><?= htmlspecialchars($_SESSION['email']) ?></strong></p>
    <p>Ваш ID у сесії: <strong><?= (int)$_SESSION['user_id'] ?></strong></p>

    <a class="logout-btn" href="logout.php">Вийти з акаунту</a>
</div>
</body>
</html>