<?php

declare(strict_types=1);

const REGEX_DATE = "/\d\d\.\d\d\.\d\d\d\d/";

require_once 'utils.php';

if (basename($_SERVER['PHP_SELF']) === "argv_to_dates.php") {
    if ($argc > 1) {
        $argvDates = array_slice($argv, 1);
        foreach ($argvDates as $date) {
            printInfo(getIsValidDateString($date)."\n");
        }
    }
}

function isValidDate(string $date): bool
{
    if (!preg_match(REGEX_DATE, $date)) {
        printError("$date is not in format dd.mm.yyyy\n");
        exit();
    }
    list($day, $month, $year) = explode('.', $date);
    return checkdate((int)$month, (int)$day, (int)$year);
}

function getIsValidDateString(string $date): string
{
    if(isValidDate($date)) {
        return "$date is OK";
    }
    return "$date is NOT OK";
}