<?php

declare(strict_types=1);

require 'utils.php';

const REGEX_PATTERN = "/[^=]+=[^=]*$/";

$stringToConvert = getUserInput('Input string in format: a=1;b=2; c=agfda; derp=; eee=');
$stringToConvert = doTrimEndSemiColon($stringToConvert);

var_dump(getArrayOfPairsFromString($stringToConvert));

function getArrayOfPairsFromString(string $stringToConvert): array
{
    $parts = explode(';', $stringToConvert);
    $parts = array_map('trim', $parts);
    foreach ($parts as $part) {
        list($key, $value) = getKeyValuePairFromString($part);
        $keyValueArray[$key] = $value;
    }
    return $keyValueArray;
}

function getKeyValuePairFromString(string $text) : array
{
    if (!preg_match(REGEX_PATTERN, $text)){
        printError("Wrong format in part $text\nInput must be in format: a=1;b=2; c=agfda; derp=; eee=\n");
        exit();
    }
    return explode('=', $text);
}

function doTrimEndSemiColon(string $text): string
{
    if ($text[-1] === ";")
    {
        $text = trim($text, ';');
    }
    return $text;
}
