<?php

declare(strict_types=1);

require_once 'utils.php';

$text = getUserInput("Enter text for transliteration");

if (!isCyrillicText($text)) {
    printError("The sting must contain only cyrillic symbols!\n");
    exit();
}

$transliteratedText = transliterateString($text);

printInfo($transliteratedText."\n");

function transliterateString(string $text): string
{
    return transliterator_transliterate('Any-Latin; Latin-ASCII', $text);
}

function isCyrillicText(string $text): bool
{
    $symbols = str_split($text, 2);
    foreach ($symbols as $symbol) {
        if (!preg_match("/[А-Яа-яЁё]/", $symbol)) {
            return false;
        }
    }
    return true;
}
