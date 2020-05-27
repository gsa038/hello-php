<?php

function getUserInput(string $text):string
{
    echo "$text\n";
    return readline();
}