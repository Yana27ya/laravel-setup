<?php
//перенаправлення, якщо метод запиту не є POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: task3_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>завдання 3: Server</title></head>
<body>
    <h2>інформація про сервер та клієнта:</h2>
    <ul>
        <li><strong>IP-адреса клієнта:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
        <li><strong>браузер (HTTP_USER_AGENT):</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?></li>
        <li><strong>назва скрипта (PHP_SELF):</strong> <?php echo $_SERVER['PHP_SELF']; ?></li>
        <li><strong>метод запиту:</strong> <?php echo $_SERVER['REQUEST_METHOD']; ?></li>
        <li><strong>шлях до файлу на сервері:</strong> <?php echo $_SERVER['SCRIPT_FILENAME']; ?></li>
    </ul>
    <a href="task3_form.php">повернутися</a>
</body>
</html>