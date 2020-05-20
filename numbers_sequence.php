<?php

declare(strict_types=1);

$numSeq = getNumsFromConsole();

echo "reverse\n";
$numSeqTemp = krsort($numSeq);
printArray($numSeq);
echo "asc\n";
$numSeqTemp = asort($numSeq);
printArray($numSeq);
echo "desc\n";
$numSeqTemp = arsort($numSeq);
printArray($numSeq);
echo "persents\n";
printNumsPercentArray($numSeq);

function printArray(array $array):void {
    foreach ($array as $value) {
        echo "$value ";
    }
    echo "\n";
}

function printNumsPercentArray(array &$array):void {
    $numSeqPercent = array_sum($array) / 100;
    foreach ($array as &$value) {
        $valuePercent = round($value / $numSeqPercent, 2);
        echo "$value - $valuePercent%\n";
    }
}

function getUserInput(string $text):string {
    echo "$text\n";
    return readline();
}

function getNumsFromConsole():array {
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