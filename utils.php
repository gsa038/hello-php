<?php

declare(strict_types=1);

function getUserInput(string $text): string
{
    echo "$text:\n";
    return readline();
}

function printInfo(string $text): void
{
    fwrite(STDOUT, $text);
}

function printError(string $text): void
{
    fwrite(STDERR, $text);
}

function getRussianPluralFormString(string $base, string $end1, string $end2, string $end3, int $count): string
{
    if ($count > 20) {
        $count = $count % 10;
    }
    if ($count === 1) {
        return $base.$end1;
    }
    if ($count > 1 && $count <=4) {
        return $base.$end2;
    }
    return $base.$end3;
}