<?php

$counters = [];

foreach ($argv as $argValue) {
    if (!isset($counters[$argValue])) {
        $counters[$argValue] = 0;
    }
    $counters[$argValue]++;
}

arsort($counters);

$echoCounter = 0;

foreach ($counters as $argKey => $argKeyCount) {
    if (!($echoCounter < 5)) {
        break;
    }
    echo "$argKey - $argKeyCount\n";
    $echoCounter++;
}