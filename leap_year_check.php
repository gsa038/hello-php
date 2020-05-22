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

if (strlen($year) > 4 || !ctype_digit($year)) {
    fwrite(STDERR, "Year must consist max 4 positive integer");
    exit();
}


fwrite(STDOUT, printBool(isLeapYear((int)$year)));

function isLeapYear(int $year): bool {
    $date = strtotime("$year-01-01");
    if (date('L',$date)) {
        return true;
    }
    return false;
}