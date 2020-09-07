<?php

declare(strict_types=1);

require_once 'utils.php';

$textToTranslate = getUserInput("Input space separated text in Camel or Snake case");

$textToTranslate = trim($textToTranslate, " ");

printInfo(getCamelSnakeTranslatedText($textToTranslate));

function getCamelSnakeTranslatedText(string $text): string
{
    $textParts = explode(" ", $text);
    
    foreach ($textParts as $index => $part) {
        if (isSnakeCase($part)) {
            $textParts[$index] = getCamelCaseTextFromSnake($part);   
            continue; 
        }
        if (isCamelCase($part)) {
            $textParts[$index] = getSnakeCaseTextFromCamel($part);
            continue;
        }
        printError("Part $part has no Snake or Camel case\n");
    }
    
    $result = implode(" ", $textParts);
    
    return $result;
}

function isSnakeCase(string $text): bool
{
    preg_match("/((^[a-z]|[^A-Z_])+([_]|$))+/", $text, $matches);
    if ($matches[0] === $text) {
        return true;
    }
    return false;
}

function isCamelCase(string $text): bool
{
    preg_match("/([A-Z][^A-Z_]*)+/", $text, $matches);
    if ($matches[0] === $text) {
        return true;
    }
    return false;
}

function getSnakeCaseTextFromCamel(string $text): string
{
    $result = "";
    for ($i = 0; $i < strlen($text); $i++) {
        if ($i === 0) {
            $result .= strtolower($text[$i]);
            continue;
        }
        if (ctype_upper($text[$i])) {
            $result .= "_".strtolower($text[$i]);
            continue;
        }
        $result .= $text[$i];
    }
    return $result;
}

function getCamelCaseTextFromSnake(string $text): string
{
    $result = "";
    for ($i = 0; $i < strlen($text); $i++) {
        if ($i === 0) {
            $result .= strtoupper($text[$i]);
            continue;
        }
        if ($text[$i] === "_") {
            $result[$i] = strtoupper($text[$i + 1]);
            $i++;
            continue;
        }
        $result .= $text[$i];
    }
    return $result;
}