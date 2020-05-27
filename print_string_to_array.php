<?php

declare(strict_types=1);

require 'utils.php';

$stringToConvert = getUserInput('Input string kind of "a=1;b=2; c=agfda; derp=; eee="');

var_dump(getArrayFromString($stringToConvert));

function getArrayFromString(string $stringToConvert): array
{
    $parts = explode(';', $stringToConvert);
    $parts = array_map('trim', $parts);
    foreach ($parts as $part) {
        list($key, $value) = explode('=', $part);
        $keyValueArray[$key] = $value;
    }
    return $keyValueArray;
}
