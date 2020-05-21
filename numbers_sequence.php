<?php

declare(strict_types=1);

$numbersSequence = getNumbersFromConsole();

if ($argc > 1) {
    for ($i = 1; $i < $argc; $i++) {
        switch ($argv[$i]) {
            case "-p":
                echo "percents\n";
                $array = getNumbersPercentArray($numbersSequence);
                foreach ($array as $key => $value) {
                    echo "$key - $value\n";
                }
                break;
            case "--order=reverse":
                echo "reverse\n";
                $array = $numbersSequence;
                krsort($array);
                printArray($array);
                break;
            case "--order=asc":
                echo "asc\n";
                $array = $numbersSequence;
                asort($array);
                printArray($array);
                break;
            case "--order=desc":
                echo "desc\n";
                $array = $numbersSequence;
                arsort($array);
                printArray($array);
                break;
            default:
                echo "Unknown argument\n";
        }
    }    
} else {
    printArray($numbersSequence);
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
    $numbersString = getUserInput("Enter a sequence of numbers in format: 1,2,3..etc.:");
    $numbers = explode(",", $numbersString);
    foreach ($numbers as $value) {
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
    return $numbers;
}