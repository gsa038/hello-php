<?php 

declare(strict_types=1);

require 'utils.php';

$numbersSystem = getUserInput("Input numbers system as integer number in range 2-16");

if (!ctype_digit($numbersSystem) || (2 > (int)$numbersSystem) || ((int)$numbersSystem > 16)) {
    printError("You need to input integer number in range 2-16 as numbers system!");
    exit();
}

$decimalNumbersSequence = explode("," , getUserInput("Input a sequence of decimal numbers in format: 1,2,3,4,5..etc"));

// check only.. For check result perfomance
foreach($decimalNumbersSequence as $number) {
    if (!ctype_digit($number)) {
        printError("$number isn't a positive decimal integer number");
        exit();
    }
}

$numbersSystem =(int)$numbersSystem;

// For optimization
$numbersSystem > 10 ? $useHex = true : $useHex = false;

$newNumbersArray = [];
foreach($decimalNumbersSequence as $number) {
    $newNumbersArray[$number] = getInNewBase($numbersSystem, $number, $useHex);
}

printInfo("Numbers system is $numbersSystem\n");
foreach($newNumbersArray as $oldNumber => $newNumber) {
    printInfo("$oldNumber = $newNumber\n");
}

function getInNewBase(int $base, string $number, bool $useHex): string
{
    $hexSymbols = ['10' => 'A', '11' => 'B', '12' => 'C', '13' => 'D', '14' => 'E', '15' => 'F'];
    $number = (int)$number;
    $reminder = 0;
    $newNumberString = '';
    while (true) {
        if ($reminder === 0) {
            $reminder = $number;
        }
        $part = $reminder % $base;
        $reminder = intdiv($reminder, $base);
        if ($useHex && (int)$part > 10) {

            $part = $hexSymbols["$part"];
        } else {
            $part = "$part";
        }
        $newNumberString = $part . $newNumberString;
        if ($reminder === 0) {
            return $newNumberString;
        }
    }
}