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

$inversedLayoutText = getInversedLayoutString($text);

printInfo($inversedLayoutText."\n");

function getInversedLayoutString(string $text): string
{
    $result = "";
    $stringArray = preg_split('/(?=[\s\S])/ius', $text, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($stringArray as $character) {
        $result .= getProcessedCharacter($character);
    }
    return $result;
}

function getProcessedCharacter(string $character): string
{
    $cyrillicLayout = array_keys(LAYOUT_MAP_RU_EN);
    $qwertyLayout = array_values(LAYOUT_MAP_RU_EN);
    
    if (in_array($character, $cyrillicLayout)) {
        return LAYOUT_MAP_RU_EN[$character];
    }
    if (in_array($character, $qwertyLayout)) {
        return array_search($character, LAYOUT_MAP_RU_EN);
    }
    return $character;
}