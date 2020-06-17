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
    return transliterator_transliterate('Russian-Latin/BGN', $text);
}

function isCyrillicText(string $text): bool
{
    for ($i = 0; $i < strlen($text); $i++) {
        if (!preg_match("/[А-Яа-яЁё]/", $text[$i])) {
            return false;
        }
    }
    return true;
}
