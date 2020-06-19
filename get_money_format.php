<?php 

declare(strict_types=1);

require 'utils.php';

$floatString = getUserInput('Введите сумму в виде десятичного числа с плавающей точкой:');

if (!preg_match("/^\d*\.?\d?\d$/", $floatString)) {
    printError("$floatString имеет формат отличный от \"12345678.90\" ");
    exit();
}

$moneyString = getMoneyString($floatString);
print($moneyString);

function getMoneyString($floatString): string
{
    setlocale(LC_ALL, 'ru_RU');
    list($rub, $coins) = explode('.', $floatString);
    $rublesPluralFormString = getRussianPluralFormString('рубл', 'ь', 'я', 'ей', (int) $rub);
    $coinsStringPart = '';
    if ((int) $coins > 0) {
        if (strlen($coins) === 1) {
            $coins .= '0';
        }
        $coinsPluralFormString = getRussianPluralFormString('коп', 'ейка', 'ейки', 'еек', (int) $coins);
        $coinsStringPart = $coins;
        $coinsStringPart = "$coins $coinsPluralFormString";
    }
    $rubDigitString = getDigitString($rub);
    $rublesStringPart = "$rubDigitString $rublesPluralFormString";
    $moneyString = "$rublesStringPart $coinsStringPart";
    return $moneyString."\n";
}

function getDigitString(string $text): string
{
    $resultText = '';
    if (strlen($text) > 3) {
        $parts = getNumbersDigitStringParts($text);
        $resultText = implode(' ', $parts);
        return $resultText;
    }
    else {
        return $text;
    }
}

function getNumbersDigitStringParts(string $text): array
{
    $resultParts = [];
    $currentStartPosition = -1;
    while (abs($currentStartPosition <= strlen($text))) {
        $currentPart = substr($text, $currentStartPosition, -3);
        array_push($resultParts, $currentPart);
        $currentStartPosition -= 3;
    }
    return $resultParts;
}