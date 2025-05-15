<?php

$file = 'birthdays.txt';

if (!file_exists($file)) {
    echo "Файл с днями рождения не найден.\n";
    exit;
}

echo "Введите имя или дату (в формате дд-мм-гггг) для удаления: ";
$input = trim(fgets(STDIN));

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$newLines = [];
$deleted = false;

foreach ($lines as $line) {
    [$name, $date] = explode(',', $line);
    $name = trim($name);
    $date = trim($date);

    if ($input !== $name && $input !== $date) {
        $newLines[] = "$name, $date";
    } else {
        $deleted = true;
    }
}

if ($deleted) {
    file_put_contents($file, implode(PHP_EOL, $newLines) . PHP_EOL);
    echo "Строка успешно удалена.\n";
} else {
    echo "Совпадений не найдено.\n";
}