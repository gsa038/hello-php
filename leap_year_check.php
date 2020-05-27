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

$isValidYear = preg_match('/-?\d+/', $year);

if (!$isValidYear) {
    fwrite(STDERR, "Year must be an integer number");
    exit();
}

$isLeapYear = getIsLeapYearString((int)$year);
$responceText = printIsLeap($isLeapYear, $year);
fwrite(STDOUT, $responceText);

function getIsLeapYearString(int $year): bool
{
    // Annalistic leap years from 45 before A.D. uo to 12 after A.D.
    $fixedLeapYears = [-42, -39, -36, -33, -30, -27, -24, -21, -18, -15, -12, -9, 8, 12];
    if ($year >= -45 && $year <= 12) {
        return in_array($year, $fixedLeapYears);
    }
    if ($year > 12) {
        // Leap years after reform of Gregory XIII in 1582
        if ($year > 1582) {
            if ($year % 400 === 0) {
                return true;
            } elseif ($year % 100 === 0) {
                return false;
            }
        }
        if ($year % 4 === 0) {
            return true;
        }
    }
    return false;
}

function printIsLeap(bool $isLeap, string $year): string
{
    if ($isLeap) {
        return "The year $year is Leap";
    }
    return "The year $year isn't Leap";
}
