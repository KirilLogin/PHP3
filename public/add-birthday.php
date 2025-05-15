<?php

require_once 'fwrite-cli.php'; 

echo "Введите имя и фамилию: ";
$name = trim(fgets(STDIN));

echo "Введите дату рождения (дд-мм-гггг): ";
$date = trim(fgets(STDIN));

if (!validateName($name)) {
    echo "Ошибка: имя содержит недопустимые символы.\n";
    exit;
}

if (!validateDate($date)) {
    echo "Ошибка: некорректная дата. Используйте формат ДД-ММ-ГГГГ.\n";
    exit;
}

$file = 'birthdays.txt';
$data = "$name, $date\n";

file_put_contents($file, $data, FILE_APPEND);
echo "Добавлено: $name, $date\n";