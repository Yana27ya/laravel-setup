<?php
session_start();

$timeoutDuration = 300; 

// перевірка часу останньої активності
if (isset($_SESSION['last_activity'])) {
    $timeSinceLastActivity = time() - $_SESSION['last_activity'];
    
    if ($timeSinceLastActivity > $timeoutDuration) {
        session_unset();
        session_destroy();
        $message = "<p style='color:red;'>ваша сесія завершилась через 5 хвилин неактивності. Оновіть сторінку, щоб почати нову.</p>";
    } else {
        $message = "<p style='color:green;'>сесія активна. ви були неактивні " . $timeSinceLastActivity . " секунд.</p>";
    }
} else {
    $message = "<p>це ваш перший візит або сесія щойно створена.</p>";
}

//оновлюємо час активності при кожному завантаженні сторінки
if (session_status() === PHP_SESSION_ACTIVE) {
    $_SESSION['last_activity'] = time();
}
?>
<!DOCTYPE html>
<html>
<head><title>завдання 5:час активності</title></head>
<body>
    <h2>перевірка таймауту сесії (5 хвилин)</h2>
    <?php echo $message; ?>
    <p>оновіть сторінку, щоб перевірити таймер або скинути час активності.</p>
</body>
</html>