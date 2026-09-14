<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["firstName"] ?? '');
    $lastName = trim($_POST["lastName"] ?? '');

    if (empty($firstName) || empty($lastName)) {
        echo "помилка:заповніть усі поля форми.";
    } 
    elseif (is_numeric($firstName) || is_numeric($lastName)) {
        echo "помилка:ім'я та прізвище повинні містити лише текст.";
    } 
    else {
        // захист від XSS атак
        $safeFirstName = htmlspecialchars($firstName);
        $safeLastName = htmlspecialchars($lastName);
        
        echo "<h3>привіт, $safeFirstName $safeLastName!</h3>";
        echo "<p>ваші дані успішно оброблено.</p>";
    }
} else {
    echo "помилка:дані не були надіслані через форму.";
}
?>