<?php

declare(strict_types=1);

$numSeq = getNumsFromConsole();

// $userAction = useMenuAction();
$userAction = useArgsAction();

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
    case "4":
        getNumsPercent($numSeq);
        break;
    default:
        echo "Wrong input!\nWill be Returned non-changed array\n";
}

foreach ($numSeq as $value) {
    echo "$value\n";
}

function getUserInput(string $text): string {
    echo "$text\n";
    return readline();
}

function getNumsFromConsole(): array {
    $numSeqString = getUserInput("Enter a sequence of numbers in format: 1,2,3..etc.:");
    $numSeqArray = explode(",", $numSeqString);
    foreach ($numSeqArray as $value) {
        if (!is_numeric($value)){
            fwrite(STDERR, "'$value' is not a number.\nAll must be a number!\n");
            exit();
        }
        if ((string)(int)$value != $value) { 
            fwrite(STDERR,"'$value' is a float!\nAll must be integer");
            exit();
        } 
        if ((!(int) $value > 0)) {
            fwrite(STDERR,"'$value' is smaller than 1.\nAll integer numbers must be greater than 0");
            exit();
        }
        $value = (int) $value;
    }
    return $numSeqArray;
}

function getNumsPercent(&$array): array {
    $valueSeqPercent = array_sum($array) / 100;
    foreach ($array as &$value) {
        $valuePercent = round($value / $valueSeqPercent, 2);
        $value = "$value - $valuePercent%\n";
    }
    unset($value);
    return $array;
}

function useMenuAction(): string {
    echo "Choose an action:\n 
        1 - Get reverse order sorted sequence\n
        2 - Get ascending sorted sequence.\n 
        3 - Get descending sorted sequence\n
        4 - Get percent of numbers of sequence\n";
    return $userAction = readline();
}

function useArgsAction(): string {
    if ($argv['-p']){
        return '4';
    }
    if ($argv['--order']) {
        switch ($argv['--order']) {
            case 'reverse':
                return '1';
            case 'asc':
                return '2';
            case 'desc':
                return '3';
            default:
                fwrite(STDERR, "Unknoun parameter of argumrent was used");
        }
    fwrite(STDERR, "Unknoun argumrent was used");
    }
}