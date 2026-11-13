<?php
$hosts = ['php-lab6-db', 'db', 'mysql', 'mariadb', '127.0.0.1', 'localhost'];
$users = ['root', 'user', 'sail'];
$passes = ['root', 'password', 'secret', ''];
$dbname = 'users_db';

$conn = null;

foreach ($hosts as $host) {
    foreach ($users as $user) {
        foreach ($passes as $pass) {
            try {
                $temp = @mysqli_init();
                $temp->options(MYSQLI_OPT_CONNECT_TIMEOUT, 1);
                if (@$temp->real_connect($host, $user, $pass, $dbname)) {
                    $conn = $temp;
                    break 3;
                }
            } catch (Throwable $e) {

            }
        }
    }
}

if (!$conn) {
    die("Помилка підключення до бази даних users_db. Перевірте параметри в db.php.");
}

$conn->set_charset("utf8mb4");