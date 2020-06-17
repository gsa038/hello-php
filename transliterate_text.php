<?php

declare(strict_types=1);

require_once 'utils.php';

$text = getUserInput("Enter text for transliteration:");

$trasliteratedText = transliterateString($text);

printInfo($trasliteratedText."\n");

function transliterateString(string $text): string
{
    return transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $text);
}