<?php

declare(strict_types=1);

$options = getopt("p::", ["order::"]);

const HELP_TEXT = <<<'EOD'
                    Available options is:
                    -p - print weight of numbers  as percents
                    --order=<reverse|asc|desc> - sorting
                    Each option must be used once!
                    EOD;

if (count($options) < ($argc - 1)) {
    echo HELP_TEXT;
    exit();
}

$numbersSequence = getNumbersFromConsole();

if (count($options) > 0) {
    foreach ($options as $opt => $value) {
        getOptionResultForSequence($opt, $numbersSequence);
    }
} else {
    printArray($numbersSequence);
}

function doOrderAndPrint(string $orderParam, array $array):void
{
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
            echo <<<'EOD'
                Wrong '--order' parameter value
                Available values <reverse|asc|desc>
                EOD;
            break;
    }
}

function printArray(array $array):void
{
    $textForPrint = implode(" ", $array);
    echo "$textForPrint\n";
}

function getNumbersPercentArray(array $array):array
{
    $numbersSequencePercent = array_sum($array) / 100;
    $numbersPercentArray = [];
    foreach ($array as $value) {
        $valuePercent = round($value / $numbersSequencePercent, 2);
        $numbersPercentArray[$value] = "$valuePercent%";
    }
    return $numbersPercentArray;
}

function getUserInput(string $text):string
{
    echo "$text\n";
    return readline();
}

function getNumbersFromConsole():array
{
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

function getOptionResultForSequence(string $option, array $sequence): void
{
    switch ($option) {
        case "p":
            echo "percents\n";
            $array = getNumbersPercentArray($sequence);
            foreach ($array as $key => $value) {
                echo "$key - $value\n";
            }
            break;
        case "order":
            if (is_array($value)) {
                foreach ($value as $param) {
                    doOrderAndPrint($param, $sequence);
                }
                break;
            }
            doOrderAndPrint($value, $sequence);
            break;
    }
}
