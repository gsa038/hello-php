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

$isLeapYear = isLeapYear((int)$year);
$responceText = printIsLeap($isLeapYear, $year);
fwrite(STDOUT, $responceText);

function isLeapYear(int $year): bool
{
    $date = strtotime("$year-01-01");
    return (bool)date('L',$date);
}

function printIsLeap(bool $isLeap, string $year): string
{
    if ($isLeap) {
        return "The year $year is Leap";
    }
    return "The year $year isn't Leap";
}
