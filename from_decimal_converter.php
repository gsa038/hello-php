<?php 

declare(strict_types=1);

require 'utils.php';

const HELP_TEXT = <<<'EOD'
            Warning!
             
            Use:
            --base parameter for set numbers system as integer number in range 2-16
            --decimals parameter for set decimals array in format : "1,10,100,1000,10000"
             
            All parameters required!
            
            EOD;

$options = getopt("", ["base::", "decimals::"]);

$decimals = null;
$base = null;

foreach ($options as $param => $value) {
    if (gettype($value) === 'array') {
        printError(HELP_TEXT);
        printError("Warning: $param option must be used once!");
        exit();
    }
    processParameter($param, $value);
}

if ($decimals === null || $base === null) {
    printError(HELP_TEXT);
    exit();
}

// check only.. For check result perfomance 
foreach($decimals as $number) {
    checkIsNumber($number);
}

$base =(int)$base;

// For optimization
$base > 10 ? $useHex = true : $useHex = false;

$newNumbersArray = [];
foreach($decimals as $number) {
    $newNumbersArray[$number] = getInNewBase($base, $number, $useHex);
}

printInfo("Numbers system is $base\n");
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

function processParameter(string $param, string $value): void
{
    switch ($param) {
        case "base":
            checkIsBase($value);
            setBase($value);
            break;
        case "decimals":
            setDecimals(explode(',', $value));
            break;
    }
}

function setBase($value): void
{
    global $base;
    $base = $value;
}

function setDecimals($value): void
{
    global $decimals;
    $decimals = $value;
}

function checkIsNumber(string $number): void
{
    if (!ctype_digit($number)) {
        printError("$number isn't a positive decimal integer number");
        exit();
    }
}

function checkIsBase(string $base): void
{
    if (!ctype_digit($base) || (2 > (int)$base) || ((int)$base > 16)) {
        printError("You need to input integer number in range 2-16 as numbers system!");
        exit();
    }
}