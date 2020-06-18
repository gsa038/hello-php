<?php

declare(strict_types=1);

require_once 'utils.php';

const LAYOUT_MAP_RU_EN = [
    'ё' => '`', 'Ё' => '~', 'й' => 'q', 'Й' => 'Q','ц' => 'w', 'Ц' => 'W', 'у' => 'e', 'У' => 'E',
    'к' => 'r','К' => 'R', 'е' => 't', 'Е' => 'T', 'н' => 'y', 'Н' => 'Y', 'г' => 'u','Г' => 'U',
    'ш' => 'i', 'Ш' => 'I', 'щ' => 'o', 'Щ' => 'O', 'з' => 'p', 'З' => 'P', 'х' => '[', 'Х' => '{',
    'ъ' => ']', 'Ъ' => '}', 'ф' => 'a', 'Ф' => 'A', 'ы' => 's', 'Ы' => 'S', 'в' => 'd', 'В' => 'D',
    'а' => 'f', 'А' => 'F', 'п' => 'g', 'П' => 'G', 'р' => 'h', 'Р' => 'H', 'о' => 'j', 'О' => 'J',
    'л' => 'k', 'Л' => 'K', 'д' => 'l', 'Д' => 'L', 'ж' => ';', 'Ж' => ':', 'э' => '\'', 'Э' => '"',
    'я' => 'z', 'Я' => 'Z', 'ч' => 'x', 'Ч' => 'X', 'с' => 'c', 'С' => 'C', 'м' => 'v', 'М' => 'V',
    'и' => 'b', 'И' => 'B', 'т' => 'n', 'Т' => 'N', 'ь' => 'm', 'Ь' => 'M', 'б' => ',', 'Б' => '<',
    'ю' => '.', 'Ю' => '>'
];

$text = getUserInput("Enter text for inversion");

$resultText = getInversedLayoutText($text);

printInfo($resultText."\n");

function getInversedLayoutText(string $text): string
{
    $result = [];
    $words = explode(' ', $text);
    foreach ($words as $word) {
        $newWord = getProcessedWord($word);
        array_push($result, $newWord);
    }
    return implode(' ', $result);
}

function getProcessedWord(string $text): string
{
    $result = "";
    $characters = preg_split('/(?=[\s\S])/ius', $text, -1, PREG_SPLIT_NO_EMPTY);
    $layout = getTargetWordLayout($characters);
    if ($layout === 'unknown') {
        $result .= implode('', $characters);
        return $result;
    }
    foreach ($characters as $character) {
        $result .= getProcessedCharacter($character, $layout);
    }
    return $result;
}

function getTargetWordLayout($word): string
{
    $cyrillicLayout = array_keys(LAYOUT_MAP_RU_EN);
    $qwertyLayout = array_values(LAYOUT_MAP_RU_EN);
    $cyrillicWeight = 0;
    $qwertyWeight = 0;
    $wasFirstLayout = 'unknown';
    foreach ($word as $i => $character) {
        if (isCyrillicCharacter($character)) {
            if ($i === 0) {
                $wasFirstLayout = 'cyrillic';
            }
            $cyrillicWeight += 1;
        }
        if (isQwertyCharacter($character)) {
            if ($i === 0) {
                $wasFirstLayout = 'qwerty';
            }
            $qwertyWeight += 1;
        }
    }
    if ($cyrillicWeight > $qwertyWeight) {
        if ($qwertyWeight === 0) {
            return 'qwerty';
        }
        return 'cyrillic';
    }
    if ($cyrillicWeight < $qwertyWeight) {
        if ($cyrillicWeight === 0) {
            return 'cyrillic';
        }
        return 'qwerty';
    }
    return $wasFirstLayout;
}

function isCyrillicCharacter(string $character): bool
{
    $cyrillicLayout = array_keys(LAYOUT_MAP_RU_EN);
    if (in_array($character, $cyrillicLayout)) {
        return true;
    }
    return false;
}

function isQwertyCharacter(string $character): bool
{
    $qwertyLayout = array_values(LAYOUT_MAP_RU_EN);
    if (in_array($character, $qwertyLayout)) {
        return true;
    }
    return false;
}

function getProcessedCharacter(string $character, string $layout): string
{
    $cyrillicLayout = array_keys(LAYOUT_MAP_RU_EN);
    $qwertyLayout = array_values(LAYOUT_MAP_RU_EN);
    
    switch ($layout) {
        case 'qwerty':
            if (isCyrillicCharacter($character))
                return LAYOUT_MAP_RU_EN[$character];
            return $character;
        case 'cyrillic':
            if (isQwertyCharacter($character))
                return array_search($character, LAYOUT_MAP_RU_EN);
            return $character;
        default:
            return $character;    
    }
    
}