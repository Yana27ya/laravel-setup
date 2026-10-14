<?php
$max_age = 86400; 
//встановлюємо заголовки кешування згідно із завданням
header('Content-Type: text/css'); //відповідний MIME-тип
header('Cache-Control: public, max-age=' . $max_age);
// обчислюємо дату закінчення (дата + 1 день)
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $max_age) . ' GMT');
?>

body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
h2 { color: #2c3e50; }