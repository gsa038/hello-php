<?php

declare(strict_types=1);

function getNumsFromConsole(): array {
    echo "Enter a sequence of numbers in format: 1,2,3..etc.:\n";
    $numSeqString = readline();
    $numSeqArray = explode(",", $numSeqString);
    foreach ($numSeqArray as $value) {
        if (!ctype_digit($value)){
            echo "Error: All parts of sequence must be an integer number!\n";
            exit();
        }
    }
    return array_map('intval', $numSeqArray);
}

$numSeq = getNumsFromConsole();

echo "Choose an action:\n 
    1 - Get ascending sorted sequence.\n 
    2 - Get descending sorted sequence\n 
    3 - Get reverse order sorted sequence\n";

$userAction = readline();
switch ($userAction) {
    case "1":
        asort($numSeq);
        break;
    case "2":
        arsort($numSeq);
        break;
    case "3":
        krsort($numSeq);
        break;
    default:
        echo "Wrong input!";
        exit();
}

foreach ($numSeq as $value)
    echo "$value ";
