<?php
session_start();

//обробка виходу
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: task2.php");
    exit;
}

//обробка входу (для прикладу логін: admin, пароль: 1234)
if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($_POST['login'] === 'admin' && $_POST['password'] === '1234') {
        $_SESSION['user'] = 'admin';
        header("Location: task2.php");
        exit;
    } else {
        $error = "невірний логін або пароль!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>завдання 2: Session</title></head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h2>вітаємо на сторінці, <?php echo htmlspecialchars($_SESSION['user']); ?>! ви успішно увійшли.</h2>
        <form method="POST">
            <button type="submit" name="logout">вихід</button>
        </form>
    <?php else: ?>
        <h2>форма входу (admin / 1234)</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="login" placeholder="логін" required><br><br>
            <input type="password" name="password" placeholder="пароль" required><br><br>
            <button type="submit">увійти</button>
        </form>
    <?php endif; ?>
</body>
</html>