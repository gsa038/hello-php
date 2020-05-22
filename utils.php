<?php

declare(strict_types=1);

function getUserInput(string $text):string {
    echo "$text:\n";
    return readline();
}

function printBool(bool $bool): string {
    if ($bool == 1) {
        return "True";
    }
    return "False";
}