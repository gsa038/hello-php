<?php

declare(strict_types=1);
if ($argc > 1) {
    $numSeq = getNumbersFromConsole();
}

for ($i = 0; $i < $argc; $i++) {
    switch ($argv[$i]) {
        case "-p":
            printNumbersPercentsArray($numSeq);
            break;
        case "--order=reverse":
            printKeyReverseSortedArray($numSeq);
            break;
        case "--order=asc":
            printValueAscendingSortedArray($numSeq);
            break;
        case "--order=desc":
            printValueDescendingSortedArray($numSeq);
            break;
    }
}

function printKeyReverseSortedArray(array $array):void {
    echo "reverse\n";
    krsort($array);
    printArray($array);
}

function printValueAscendingSortedArray(array $array):void {
    echo "asc\n";
    asort($array);
    printArray($array);
}

function printValueDescendingSortedArray(array $array):void {
    echo "desc\n";
    arsort($array);
    printArray($array);
}

function printNumbersPercentsArray(array $array):void {
    echo "percents\n";
    $numSeqTemp = getNumbersPercentArray($array);
    foreach ($numSeqTemp as $key => $value) {
        echo "$key - $value\n";
    }
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
    $numSeqString = getUserInput("Enter a sequence of numbers in format: 1,2,3..etc.:");
    $numSeqArray = explode(",", $numSeqString);
    foreach ($numSeqArray as $value) {
        if (!is_numeric($value)){
            fwrite(STDERR, "'$value' is not a number.\nAll must be a number!\n");
            exit();
        }
        if (is_float($value != (string)(int)$value)){ 
            fwrite(STDERR,"'$value' is a float!\nAll must be integer");
            exit();
        } 
        if ((!(int) $value > 0)) {
            fwrite(STDERR,"'$value' is smaller than 1.\nAll integer numbers must be greater than 0");
            exit();
        }
        $value = (int)$value;
    }
    return $numSeqArray;
}