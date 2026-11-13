<?php
session_start();
require_once __DIR__ . '/db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Будь ласка, заповніть усі поля.";
    } else {
        $hashedPassword = md5($password);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        try {
            if ($stmt->execute()) {
                $message = "Реєстрація успішна! Тепер ви можете <a href='login.php'>увійти</a>.";
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $error = "Користувач із таким ім'ям або email вже існує.";
            } else {
                $error = "Помилка бази даних: " . $e->getMessage();
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація — Лабораторна №6</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; display: flex; justify-content: center; padding-top: 60px; }
        .card { background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 360px; }
        h2 { margin-top: 0; color: #333; text-align: center; }
        label { display: block; margin-top: 12px; font-size: 14px; color: #555; }
        input { width: 100%; padding: 9px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; margin-top: 18px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        button:hover { background: #218838; }
        .msg { padding: 10px; border-radius: 4px; margin-bottom: 12px; font-size: 14px; }
        .error { background: #f8d7da; color: #721c24; }
        .success { background: #d4edda; color: #155724; }
        .switch { text-align: center; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>
<div class="card">
    <h2>Реєстрація</h2>

    <?php if ($error): ?>
        <div class="msg error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($message): ?>
        <div class="msg success"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" name="username" required maxlength="50">

        <label for="email">Електронна пошта:</label>
        <input type="email" id="email" name="email" required maxlength="100">

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Зареєструватися</button>
    </form>

    <div class="switch">
        Вже маєте акаунт? <a href="login.php">Увійти</a>
    </div>
</div>
</body>
</html>