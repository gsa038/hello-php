<?php

function getUserAgeFromConsole() {
    echo "Enter your age:\n";
    $userAgeString = readline();
    if (is_numeric($userAgeString))
        return (int) $userAgeString;
    else
        echo "Error: your age must be a number!\n";
        exit();
}

$userAge = getUserAgeFromConsole();

$writersBirthdayYears = [
    "Lermontov" => "1814",
    "Pushkin" => "1799",
    "Lev Tolstoy" => "1828"
];

$userBirthDate = date("Y") - $userAge;
foreach ($writersBirthdayYears as $writer => $date) {
    $diffDate = $userBirthDate - $date;
    echo "You're younger than $writer for $diffDate years\n";
}





