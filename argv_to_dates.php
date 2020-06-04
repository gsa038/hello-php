<?php

declare(strict_types=1);

const REGEX_DATE = "/\d\d\.\d\d\.\d\d\d\d/";

require 'utils.php';

if ($argc > 1) {
    $argvDates = array_slice($argv, 1);
    foreach ($argvDates as $date) {
        printInfo(getIsValidDateString($date)."\n");
    }
}

function isValidDate(string $date): bool
{
    if (!preg_match(REGEX_DATE, $date)) {
        printError("$date is not in format dd.mm.yyyy\n");
        exit();
    }
    list($day, $month, $year) = explode('.', $date);
    if (isValidMonth((int)$month)) {
        return isValidDay((int)$day, (int)$month, (int)$year);
    }
    return false;
}

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
        if (getIsLeapYear($year)) {
            return 29;
        }
    }
    $monthLengths = [31,28,31,30,31,30,31,31,30,31,30,31];
    return $monthLengths[$month - 1];
}

function getIsValidDateString(string $date): string
{
    if(isValidDate($date)) {
        return "$date is OK";
    }
    return "$date is NOT OK";
}