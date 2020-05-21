<?php

declare(strict_types=1);

require 'utils.php';

if ($argc > 2) {
    echo "1 additional aggument expected";
    exit();
}

if ($argc == 1) {
    $year = getUserInput("Enter year as integer number");
}

if ($argc == 2) {
    $year = $argv[1];
}

if (strlen($year) != 4 || !ctype_digit($year)) {
    fwrite(STDERR, "Year must consist 4 positive integer");
    exit();
}

fwrite(STDOUT, isLeapYear((int)$year));

function isLeapYear(int $year):string {
    $date = strtotime("$year-01-01");
    if (date('L',$date)) {
        return "True";
    }
    return "False";
}