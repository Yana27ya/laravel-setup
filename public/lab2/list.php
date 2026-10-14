<?php
$uploadDir = 'uploads/';

echo "<h2>список файлів у директорії uploads:</h2>";

if (is_dir($uploadDir)) {
    //отримуємо список усіх файлів у папці
    $files = scandir($uploadDir);
    
    echo "<ul>";
    $hasFiles = false;
    foreach ($files as $file) {
        //пропускаємо системні директорії . та ..
        if ($file !== '.' && $file !== '..') {
            $hasFiles = true;
            $filePath = $uploadDir . $file;
            //виводимо посилання з атрибутом download
            echo "<li><a href='" . htmlspecialchars($filePath) . "' download>" . htmlspecialchars($file) . "</a></li>";
        }
    }
    echo "</ul>";

    if (!$hasFiles) {
        echo "<p>у директорії поки немає завантажених файлів.</p>";
    }
} else {
    echo "<p>директорія <strong>uploads</strong> не існує. завантажте спочатку файл.</p>";
}

echo "<br><a href='index.html'>повернутися на головну</a>";
?>
