<?php

$writers_birthdays = array(
    "Lermontov" => "1814-10-15",
    "Pushkin" => "1799-06-06",
    "Lev Tolstoy" => "1828-09-09"
);

echo "Enter your age\n";
intval($user_age = readline());
$user_min_birth_date = date_create(date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y") - $user_age)));

foreach ($writers_birthdays as $writer => $date) {

    $diff_date = date_diff(date_create($date), $user_min_birth_date);
    echo "You're younger than $writer at least for $diff_date->y years\n";
}


