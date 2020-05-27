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