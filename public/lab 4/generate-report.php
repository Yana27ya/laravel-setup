<?php
$cacheDir = 'cache/';
$cacheFile = $cacheDir . 'report.html';
$cacheLife = 600; 

//перевіряємо, чи існує файл кешу і чи його вік менше 10 хвилин
if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheLife)) {
    echo "<p style='color:green;'>звіт завантажено з кешу (миттєво).</p>";
    echo file_get_contents($cacheFile);
    exit;
}

//затримка виконання для симуляції тривалої обробки
sleep(3);

//генерація 1000 рядків таблиці з випадковими даними
$html = "<table border='1' cellpadding='5'><tr><th>Ім'я</th><th>сума (грн)</th><th>Дата</th></tr>";
for ($i = 1; $i <= 1000; $i++) {
    $sum = rand(100, 5000);
    $date = date("Y-m-d", time() - rand(0, 31536000));
    $html .= "<tr><td>Користувач $i</td><td>$sum</td><td>$date</td></tr>";
}
$html .= "</table>";

//створюємо папку cache, якщо її немає, і записуємо звіт у файл-кеш
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}
file_put_contents($cacheFile, $html);

//повертаємо результат
echo "<p style='color:red;'>згенеровано новий звіт (витрачено 3 сек).</p>";
echo $html;
?>
