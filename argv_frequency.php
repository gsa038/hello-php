<?php

$counters = [];

foreach ($argv as $argValue) {
    if (!isset($counters[$argValue])) {
        $counters[$argValue] = 0;
    }
    $counters[$argValue]++;
}

arsort($counters);

$top5Argv = array_slice($counters, 0, 5, true);

foreach ($top5Argv as $argKey => $argKeyCount) {
    echo "$argKey - $argKeyCount\n";
}