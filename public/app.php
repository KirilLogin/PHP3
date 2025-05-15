<?php

require_once 'fwrite-cli.php';

while (true) {
    echo "\nВыберите действие:\n";
    echo "1. Добавить день рождения\n";
    echo "2. Найти по дате\n";
    echo "3. Удалить запись\n";
    echo "4. Показать все записи\n";
    echo "0. Выход\n";
    echo "Введите номер действия: ";
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1':
            addBirthday();
            break;
        case '2':
            findBirthday();
            break;
        case '3':
            deleteBirthday();
            break;
        case '4':
            showAll();
            break;
        case '0':
            echo "Выход...\n";
            exit;
        default:
            echo "Некорректный ввод. Попробуйте снова.\n";
    }
}