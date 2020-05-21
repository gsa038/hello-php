<?php

declare(strict_types=1);

$numbersSequence = getNumbersFromConsole();

echo "reverse\n";
$numbers = $numbersSequence;
krsort($numbers);
printArray($numbers);

echo "asc\n";
$numbers = $numbersSequence;
asort($numbers);
printArray($numbers);

echo "desc\n";
$numbers = $numbersSequence;
arsort($numbers);
printArray($numbers);

echo "percents\n";
$numbers = getNumbersPercentArray($numbersSequence);
foreach ($numbers as $key => $value) {
    echo "$key - $value\n";
}

function printArray(array $array):void {
    foreach ($array as $value) {
        echo "$value ";
    }
    echo "\n";
}

function getNumbersPercentArray(array $array):array {
    $numbersSequencePercent = array_sum($array) / 100;
    $numbersPercentArray = [];
    foreach ($array as $value) {
        $valuePercent = round($value / $numbersSequencePercent, 2);
        $numbersPercentArray[$value] = "$valuePercent%";
    }
    return $numbersPercentArray;
}

function getUserInput(string $text):string {
    echo "$text\n";
    return readline();
}

function getNumbersFromConsole():array {
    $numbersSequenceString = getUserInput("Enter a sequence of numbers in format: 1,2,3..etc.:");
    $numbersSequenceArray = explode(",", $numbersSequenceString);
    foreach ($numbersSequenceArray as $value) {
        if (!is_numeric($value)){
            fwrite(STDERR, "'$value' is not a number.\nAll must be a number!\n");
            exit();
        }
        if (is_float($value + 0)) { 
            fwrite(STDERR,"'$value' is a float!\nAll must be integer");
            exit();
        } 
        if ((!(int) $value > 0)) {
            fwrite(STDERR,"'$value' is smaller than 1.\nAll integer numbers must be greater than 0");
            exit();
        }
        $value = (int)$value;
    }
    return $numbersSequenceArray;
}