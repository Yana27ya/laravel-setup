<?php

require_once 'AccountInterface.php';

class BankAccount implements AccountInterface
{
    public const MIN_BALANCE = 0;

    protected float $balance;
    protected string $currency;

    public function __construct(float $initialBalance = 0, string $currency = "USD")
    {
        if ($initialBalance < self::MIN_BALANCE) {
            throw new Exception("початковий баланс не може бути менше " . self::MIN_BALANCE . ".");
        }
        $this->balance = $initialBalance;
        $this->currency = $currency;
    }

    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new Exception("некоректна сумма для поповнення: сума повиння бути більше нуля.");
        }
        $this->balance += $amount;
    }

    public function withdraw(float $amount): void
    {
        if ($amount <= 0) {
            throw new Exception("некоректна сума для зняття: сума повинна бути більше нуля.");
        }

        if (($this->balance - $amount) < self::MIN_BALANCE) {
            throw new Exception("недостатньо коштів");
        }

        $this->balance -= $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}