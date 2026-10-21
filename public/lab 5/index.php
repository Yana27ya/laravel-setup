<?php
header('Content-Type: text/plain; charset=utf-8');

require_once 'BankAccount.php';
require_once 'SavingsAccount.php';

echo "=== тестування звичайного балансу (BankAccount) ===\n";

try {
    $account1 = new BankAccount(100, "USD");
    echo "рахунок є. Баланс: " . $account1->getBalance() . " " . $account1->getCurrency() . "\n";

    // поповнення рахунку
    $account1->deposit(50);
    echo "після поповнення на 50: " . $account1->getBalance() . " " . $account1->getCurrency() . "\n";

    $account1->withdraw(30);
    echo "після зняття 30: " . $account1->getBalance() . " " . $account1->getCurrency() . "\n";


    echo "спроба зняти 200 USD...\n";
    $account1->withdraw(200);
} catch (Exception $e) {
    echo "помилка: " . $e->getMessage() . "\n";
}

echo "\n=== тестування некоректних сум ===\n";

try {
    $account2 = new BankAccount(50, "EUR");
    echo "спроба поповнити рахунок на -20 EUR...\n";
    $account2->deposit(-20);
} catch (Exception $e) {
    echo "помилка: " . $e->getMessage() . "\n";
}

try {
    echo "спроба зняти з рахунку -10 EUR...\n";
    $account2->withdraw(-10);
} catch (Exception $e) {
    echo "помилка: " . $e->getMessage() . "\n";
}

echo "\n=== тестування накопичувального рахунку(SavingsAccount) ===\n";

try {
    SavingsAccount::$interestRate = 0.10;

    $savings = new SavingsAccount(1000, "UAH");
    echo "накопичувальний рахунок є. баланс: " . $savings->getBalance() . " " . $savings->getCurrency() . "\n";

    $savings->applyInterest();
    echo "баланс після начислення відсотків (" . (SavingsAccount::$interestRate * 100) . "%): " 
         . $savings->getBalance() . " " . $savings->getCurrency() . "\n";

    $savings->withdraw(500);
    echo "після зняття 500: " . $savings->getBalance() . " " . $savings->getCurrency() . "\n";
} catch (Exception $e) {
    echo "помилка: " . $e->getMessage() . "\n";
}