<?php

declare(strict_types=1);

function getNumsFromConsole(): array {
    echo "Enter a sequence of numbers in format: 1,2,3..etc.:\n";
    $numSeqString = readline();
    $numSeqArray = explode(",", $numSeqString);
    foreach ($numSeqArray as $value) {
        if (!is_numeric($value)){
            echo "One of sequence members not a number.\nAll must be a number!\n";
            exit();
        }
        // first variant input float cheching is using
        // Second variant check ($f == (string)(float)$f)
        elseif (is_float($value + 0)){ 
            echo "One of sequence members is a float!\nAll must be integer";
            exit();
        } 
        elseif ((!(int) $value > 0)) {
            echo "All integer numbers must be greater than 0";
            exit();
        }
    }
    return array_map('intval', $numSeqArray);
}

$numSeq = getNumsFromConsole();

echo "Choose an action:\n 
    1 - Get reverse order sorted sequence\n
    2 - Get ascending sorted sequence.\n 
    3 - Get descending sorted sequence\n";

$userAction = readline();
switch ($userAction) {
    case "1":
        krsort($numSeq);
        break;
    case "2":
        asort($numSeq);
        break;
    case "3":
        arsort($numSeq);
        break;
    default:
        echo "Wrong input!";
        exit();
}

$numSeqPercent = array_sum($numSeq) / 100;
foreach ($numSeq as $value) {
    $valuePercent = round($value / $numSeqPercent, 2) ;
    echo "$value - $valuePercent%\n";
}