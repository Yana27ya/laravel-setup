<?php
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploaded_file'])) {
    $file = $_FILES['uploaded_file'];

    //перевірка, чи файл успішно завантажений через HTTP POST
    if (is_uploaded_file($file['tmp_name'])) {
        
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $maxSize = 2 * 1024 * 1024; // 2 МБ у байтах

        //перевірка типу та розміру файлу
        if (in_array($fileExtension, $allowedExtensions) && $file['size'] <= $maxSize) {
            
            $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
            $fileName = $file['name'];
            $targetPath = $uploadDir . $fileName;

            //перевірка наявності файлу з таким ім'ям
            if (file_exists($targetPath)) {
                echo "<p style='color: orange;'>файл з таким ім'ям вже існує. до назви додано унікальний суфікс.</p>";
                $fileName = $originalName . '_' . time() . '.' . $fileExtension;
                $targetPath = $uploadDir . $fileName;
            }

            //переміщення файлу у цільову папку
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                echo "<h3>Файл успішно завантажено!</h3>";
                echo "<ul>";
                echo "<li><strong>Ім'я файлу:</strong> " . htmlspecialchars($fileName) . "</li>";
                echo "<li><strong>Тип:</strong> " . htmlspecialchars($file['type']) . "</li>";
                echo "<li><strong>Розмір:</strong> " . round($file['size'] / 1024, 2) . " КБ</li>";
                echo "</ul>";
                
                //посилання на завантаження
                echo "<p><a href='" . htmlspecialchars($targetPath) . "' download>Завантажити файл назад</a></p>";
            } else {
                echo "<p style='color: red;'>помилка при збереженні файлу на сервері.</p>";
            }
            
        } else {
            echo "<p style='color: red;'>помилка: дозволено лише зображення (png, jpg, jpeg) з розміром не більше 2 МБ.</p>";
        }
    } else {
        echo "<p style='color: red;'>помилка: файл не був завантажений належним чином.</p>";
    }
} else {
    echo "<p>немає даних для обробки.</p>";
}

echo "<br><a href='index.html'>повернутися на головну</a>";
?>