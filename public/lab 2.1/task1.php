<?php
// обробка видалення cookie
if (isset($_POST['delete_cookie'])) {
    setcookie('username', '', time() - 3600, "/"); //встановлюємо час у минулому
    header("Location: task1.php");
    exit;
}

//обробка збереження імені
if (isset($_POST['username']) && !empty(trim($_POST['username']))) {
    $name = htmlspecialchars(trim($_POST['username']));
    // зберігаємо на 7 днів (7 днів * 24 години * 60 хвилин * 60 секунд)
    setcookie('username', $name, time() + (7 * 24 * 60 * 60), "/");
    header("Location: task1.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>завдання 1: Cookie</title></head>
<body>
    <?php if (isset($_COOKIE['username'])): ?>
        <h2>Привіт, <?php echo htmlspecialchars($_COOKIE['username']); ?>! раді бачити вас знову.</h2>
        <form method="POST">
            <button type="submit" name="delete_cookie">видалити Cookie</button>
        </form>
    <?php else: ?>
        <h2>введіть ваше ім'я:</h2>
        <form method="POST">
            <input type="text" name="username" required>
            <button type="submit">зберегти</button>
        </form>
    <?php endif; ?>
</body>
</html>