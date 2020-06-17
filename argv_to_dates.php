<?php

declare(strict_types=1);

const REGEX_DATE = "/\d\d\.\d\d\.\d\d\d\d/";

require_once 'utils.php';

if ($argc > 1) {
    foreach ($array_slice($argv, 1) as $date) {
        printInfo(getIsValidDateString($date)."\n");
    }
    exit();
}

printError("You need to enter dates in arguments");

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