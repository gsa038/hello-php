<?php

function enterUserAge() {
    define("MESSAGE1",  "Enter your age:");
    define("MESSAGE2",  "Enter your age as a number:");
    $message = MESSAGE1;
    while (true) {
        echo "$message\n";
        $userAgeString = readline();
        if (is_numeric($userAgeString))
            return (int) $userAgeString;
        elseif ($message != MESSAGE2)
            $message = MESSAGE2;
    }
}

$userAge = enterUserAge();

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





