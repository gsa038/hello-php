<?php 

declare(strict_types=1);

require 'utils.php';

$numbersSystem = getUserInput("Please input numbers system as integer number in range 2-16");

if (!ctype_digit($numbersSystem) || (2 > (int)$numbersSystem) || ((int)$numbersSystem > 16)) {
    fwrite(STDERR, "You need to input integer number in range 2-16 as numbers system!");
    exit();
}

$decimalNumbersSequence = explode("," , getUserInput("Please input a sequence of decumal number looks as 1,2,3,4,5..etc"));

// check only.. For check result perfomance
foreach($decimalNumbersSequence as $number) {
    if (!ctype_digit($number)) {
        fwrite(STDERR, "$number isn't a positive decimal integer number");
        exit();
    }
}

$hexSymbols = ['10' => 'A', '11' => 'B', '12' => 'C', '13' => 'D', '14' => 'E', '15' => 'F'];

$numbersSystem =(int)$numbersSystem;

// For optimization
$numbersSystem > 10 ? $useHex = true : $useHex = false;

$newNumbersArray = [];
foreach($decimalNumbersSequence as $number) {
    $number = (int)$number;
    $reminder = 0;
    $newNumberString = '';
    do {
        if ($reminder === 0) {
            $reminder = $number;
        }
        $part = $reminder % $numbersSystem;
        $reminder = intdiv($reminder, $numbersSystem);
        if ($useHex && (int)$part > 10) {
            $part = $hexSymbols["$part"];
        } else {
            $part = "$part";
        }
        $newNumberString = $part . $newNumberString;
    }
    while ($reminder !== 0);
    $newNumbersArray[$number] = $newNumberString;
}

fwrite(STDOUT, "Numbers system is $numbersSystem\n");
foreach($newNumbersArray as $oldNumber => $newNumber) {
    fwrite(STDOUT, "$oldNumber = $newNumber\n");
}