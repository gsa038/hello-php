<?php

declare(strict_types=1);

function getUserInput(string $text):string {
    echo "$text:\n";
    return readline();
}
