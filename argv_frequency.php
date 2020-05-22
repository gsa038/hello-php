<?php

$counters = [];

foreach ($argv as $argValue) {
    if (!isset($counters[$argValue])) {
        $counters[$argValue] = 0;
    }
    $counters[$argValue]++;
}

arsort($counters);

foreach (array_slice($counters, 0, 5, true) as $argKey => $argKeyCount) {
    echo "$argKey - $argKeyCount\n";
}