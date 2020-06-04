<?php

declare(strict_types=1);

require 'utils.php';
require "leap_year_check.php";

const REGEX_DATE = "/\d\d\.\d\d\.\d\d\d\d/";

if ($argc > 1) {
    foreach ($argv as $arg) {
        if(isValidDate($arg)) {
            $dates[$arg] = "OK";
        }
        $dates[$arg] = "NOT OK";
    }
}

printArray($dates);

function isValidDate(string $date): bool
{
    if (!preg_match(REGEX_DATE, $date)) {
        printError("$date is not in format dd.mm.yyyy");
        exit();
    }
    list($day, $month, $year) = explode('.', $date);
    if (isValidMonth((int)$month)) {
        return isValidDay((int)$day, (int)$month, (int)$year);
    }

    // if ($month[0] === "0") {
    //     $month = trimFirstZero($month);
    // }
    
    // if ($day[0] === "0") {
    //     $day = trimFirstZero($day);
    // }
}

// function trimFirstZero(string $text): string
// {
//     if ($text[0] === "0") {
//         $text = $text[1];
//     }
//     return $text;
// }

function isValidMonth(int $month): bool
{
    if (($month !== 0) && ($month <= 12)) {
        return true;
    }
    return false;
}

function isValidDay(int $day, int $month, int $year): bool
{
    if (($day !== 0) && ($day <= getMaxDayOfMonth($month, $year))) {
        return true;
    }
    return false;
}

function getMaxDayOfMonth(int $month, int $year): int
{
    if ($month === 4) {
        if (getIsLeapYear((int)$year)) {
            return 29;
        }
    }
    $monthLengths = [31,28,31,30,31,30,31,31,30,31,30,31];
    return $monthLengths[$month];
}