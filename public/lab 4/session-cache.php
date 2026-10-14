<?php
session_start();

//функція для генерації даних із затримкою
function generateData() {
    sleep(2); // симуляція навантаження
    return ['usd' => rand(35, 40), 'eur' => rand(38, 43)];
}

// перевірка наявності кешу в сесії
if (isset($_SESSION['cached_data']) && isset($_SESSION['cached_time'])) {
    $age = time() - $_SESSION['cached_time'];
    
    //якщо кешу менше 600 секунд 
    if ($age < 600) {
        $data = $_SESSION['cached_data'];
        $source = 'з кешу сесії';
    } else {
        $data = generateData();
        $_SESSION['cached_data'] = $data;
        $_SESSION['cached_time'] = time();
        $source = 'оновлено кеш';
    }
} else {
    //якщо кешу немає, генеруємо новий
    $data = generateData();
    $_SESSION['cached_data'] = $data;
    $_SESSION['cached_time'] = time();
    $source = 'створено новий кеш';
}

echo "<h2>курси валют</h2>";
echo "<p>дані: " . json_encode($data) . "</p>";
echo "<p>джерело: <strong>$source</strong></p>";
echo "<br><a href='index.php'>повернутися назад</a>";
?>