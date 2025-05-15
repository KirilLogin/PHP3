<?php

$file = 'birthdays.txt';

if (!file_exists($file)) {
    echo "Файл с днями рождения не найден.\n";
    exit;
}

$today = date('d-m');
$found = false;

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    [$name, $date] = explode(',', $line);
    $name = trim($name);
    $date = trim($date);

    // Из даты берём только день и месяц
    $birthDayMonth = date('d-m', strtotime($date));

    if ($birthDayMonth === $today) {
        echo "Сегодня день рождения у: $name\n";
        $found = true;
    }
}

if (!$found) {
    echo "Сегодня ни у кого нет дня рождения.\n";
}