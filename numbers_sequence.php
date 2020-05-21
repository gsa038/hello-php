<?php

declare(strict_types=1);

$options = getopt("p::", ["order::"]);
$numbersSequence = getNumbersFromConsole();

if (count($options) > 0) {
    foreach ($options as $opt => $value) {
        switch ($opt) {
            case "p":
                echo "percents\n";
                $array = getNumbersPercentArray($numbersSequence);
                foreach ($array as $key => $value) {
                    echo "$key - $value\n";
                }
                break;
            case "order":
                if (is_array($value)) {
                    foreach ($value as $param) {
                        doOrderAndPrint($param, $numbersSequence);
                    }
                    break;
                }
                doOrderAndPrint($value, $numbersSequence);
                break;
            default:
                echo "Unknown argument\n";
        }
    }
} else {
    printArray($numbersSequence);
}

function doOrderAndPrint(string $orderParam, array $array):void {
    switch ($orderParam) {
        case "reverse":
            echo "reverse\n";
            krsort($array);
            printArray($array);
            break;
        case "asc":
            echo "asc\n";
            asort($array);
            printArray($array);
            break;
        case "desc":
            echo "desc\n";
            arsort($array);
            printArray($array);
            break;
        default:
            echo "Wrong '--order' parameter value\n";
            break;
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
    $numbersString = getUserInput("Enter a sequence of numbers in format: 1,2,3..etc.:");
    $numbers = explode(",", $numbersString);
    foreach ($numbers as $value) {
        if (!is_numeric($value)){
            fwrite(STDERR, "'$value' is not a number.\nAll must be a number!\n");
            exit();
        }
        if ($value != (string)(int)$value){ 
            fwrite(STDERR,"'$value' is a float!\nAll must be integer");
            exit();
        }
        if (!((int)$value > 0)) {
            fwrite(STDERR,"'$value' is smaller than 1.\nAll integer numbers must be greater than 0");
            exit();
        }
        $value = (int)$value;
    }
    return $numbers;
}