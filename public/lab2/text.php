<?php
$logFile = 'log.txt';

//запис у файл
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['log_text'])) {
    $text = $_POST['log_text'] . PHP_EOL; // додаємо перенесення рядка
    // FILE_APPEND дозволяє дописувати дані у кінець файлу, не затираючи старі
    file_put_contents($logFile, $text, FILE_APPEND);
    echo "<p style='color: green;'>дані успішно записано у файл <strong>log.txt</strong>.</p>";
}

//читання з файлу
echo "<h3>вміст файлу log.txt:</h3>";
if (file_exists($logFile)) {
    $content = file_get_contents($logFile);
    //виводимо вміст з урахуванням HTML-сутностей для безпеки
    echo "<pre style='background: #f4f4f4; padding: 10px;'>" . htmlspecialchars($content) . "</pre>";
} else {
    echo "<p>файл log.txt ще не створено або він порожній.</p>";
}

echo "<br><a href='index.html'>повернутися на головну</a>";
?>