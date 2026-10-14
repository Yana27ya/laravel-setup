<?php
session_start();

//додавання товару в поточний кошик (сесія)
if (isset($_POST['add_item']) && !empty($_POST['item'])) {
    $_SESSION['cart'][] = htmlspecialchars($_POST['item']);
    header("Location: task4.php");
    exit;
}

// оформлення замовлення (перенесення із сесії в cookie)
if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {
    $existingPurchases = isset($_COOKIE['past_purchases']) ? json_decode($_COOKIE['past_purchases'], true) : [];
    $allPurchases = array_merge($existingPurchases, $_SESSION['cart']);
    
    //зберігаємо всі покупки в cookie на 30 днів
    setcookie('past_purchases', json_encode($allPurchases), time() + (30 * 24 * 60 * 60), "/");
    unset($_SESSION['cart']); //очищаємо поточний кошик
    header("Location: task4.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>завдання 4: кошик</title></head>
<body>
    <h2>додати товар у кошик:</h2>
    <form method="POST">
        <input type="text" name="item" placeholder="назва товару" required>
        <button type="submit" name="add_item">додати</button>
    </form>

    <h3>поточний кошик (збережено в сесії):</h3>
    <?php if (!empty($_SESSION['cart'])): ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $item) echo "<li>$item</li>"; ?>
        </ul>
        <form method="POST">
            <button type="submit" name="checkout">оформити замовлення</button>
        </form>
    <?php else: ?>
        <p>кошик порожній.</p>
    <?php endif; ?>

    <hr>
    <h3>попередні покупки (збережено в Cookie):</h3>
    <?php if (isset($_COOKIE['past_purchases'])): ?>
        <ul>
            <?php 
            $pastItems = json_decode($_COOKIE['past_purchases'], true);
            foreach ($pastItems as $pastItem) echo "<li>$pastItem</li>"; 
            ?>
        </ul>
    <?php else: ?>
        <p>історія покупок порожня.</p>
    <?php endif; ?>
</body>
</html>