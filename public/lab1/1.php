<?php

//завдання1
echo "Hello, World!\n"; 

//завдання2
$strVar = "Текстовий рядок"; 
$intVar = 42;             
$floatVar = 3.14;         
$boolVar = true;  

echo $strVar . "\n";
echo $intVar . "\n";
echo $floatVar . "\n";
echo $boolVar . "\n"; 

var_dump($strVar, $intVar, $floatVar, $boolVar);

//завдання3
$part1 = "PHP ";
$part2 = "розробка";
$resultString = $part1 . $part2;
echo $resultString . "\n";

//завдання4
$number = 15;
if ($number % 2 == 0) {
    echo "число $number є парним.\n";
} else {
    echo "число $number є непарним.\n";
}

//завдання5
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "\n";

$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "\n";

//завдання6
$student = [
    "ім'я" => "Яна",
    "прізвище" => "Колодяжна",
    "вік" => 18,
    "спеціальність" => "Комп'ютерна графіка та моделювання (ІКМ-224в)"
];

foreach ($student as $key => $value) {
    echo $key . ": " . $value . "\n";
}

$student["середній бал"] = 92.5;

echo "\nОновлений масив:\n";
print_r($student);
?>