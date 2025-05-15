function validateName($name) {
    return preg_match("/^[А-Яа-яЁё\s\-]+$/u", $name);
}

function validateDate($date) {
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d && $d->format('d-m-Y') === $date;
}