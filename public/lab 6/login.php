<?php
session_start();
require_once __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: Welcome.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Введіть ім'я користувача та пароль.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Перевірка пароля через password_verify() або md5() 
            if (password_verify($password, $user['password']) || md5($password) === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                header("Location: Welcome.php");
                exit;
            } else {
                $error = "Невірний пароль.";
            }
        } else {
            $error = "Користувача з таким ім'ям не знайдено.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Авторизація — Лабораторна №6</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; display: flex; justify-content: center; padding-top: 60px; }
        .card { background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 360px; }
        h2 { margin-top: 0; color: #333; text-align: center; }
        label { display: block; margin-top: 12px; font-size: 14px; color: #555; }
        input { width: 100%; padding: 9px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; margin-top: 18px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        button:hover { background: #0069d9; }
        .msg { padding: 10px; border-radius: 4px; margin-bottom: 12px; font-size: 14px; background: #f8d7da; color: #721c24; }
        .switch { text-align: center; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>
<div class="card">
    <h2>Вхід у систему</h2>

    <?php if ($error): ?>
        <div class="msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Увійти</button>
    </form>

    <div class="switch">
        Ще не зареєстровані? <a href="register.php">Створити акаунт</a>
    </div>
</div>
</body>
</html>