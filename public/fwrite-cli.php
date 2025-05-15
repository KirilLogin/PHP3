<?php

function validateName($name) {
    return preg_match("/^[А-Яа-яЁё\s\-]+$/u", $name);
}

function validateDate($date) {
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d && $d->format('d-m-Y') === $date;
}

function addBirthday() {
    echo "Введите имя: ";
    $name = trim(fgets(STDIN));

    if (!validateName($name)) {
        echo "Некорректное имя.\n";
        return;
    }

    echo "Введите дату (дд-мм-гггг): ";
    $date = trim(fgets(STDIN));

    if (!validateDate($date)) {
        echo "Некорректная дата.\n";
        return;
    }

    file_put_contents('birthdays.txt', "$name, $date" . PHP_EOL, FILE_APPEND);
    echo "Запись добавлена.\n";
}

function findBirthday() {
    $today = date('d-m');
    $lines = file('birthdays.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $found = false;

    foreach ($lines as $line) {
        [$name, $date] = explode(',', $line);
        $date = trim($date);
        if (substr($date, 0, 5) === $today) {
            echo "$name, $date\n";
            $found = true;
        }
    }

    if (!$found) {
        echo "Сегодня нет именинников.\n";
    }
}

function deleteBirthday() {
    echo "Введите имя или дату (дд-мм-гггг): ";
    $input = trim(fgets(STDIN));

    $lines = file('birthdays.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $newLines = [];
    $deleted = false;

    foreach ($lines as $line) {
        [$name, $date] = explode(',', $line);
        if (trim($name) !== $input && trim($date) !== $input) {
            $newLines[] = $line;
        } else {
            $deleted = true;
        }
    }

    if ($deleted) {
        file_put_contents('birthdays.txt', implode(PHP_EOL, $newLines) . PHP_EOL);
        echo "Запись удалена.\n";
    } else {
        echo "Совпадений не найдено.\n";
    }
}

function showAll() {
    if (!file_exists('birthdays.txt')) {
        echo "Файл не найден.\n";
        return;
    }

    $lines = file('birthdays.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        echo $line . PHP_EOL;
    }
}