<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    $app->get('/hello/{yourName}', \GSA\Controller\HomeAction::class);
    $app->get('/factorial/{number}', \GSA\Controller\Factorial::class);
    $app->get('/fibonacci/{number}', \GSA\Controller\Fibonacci::class);
    $app->get('/hanoi/{number}', \GSA\Controller\Hanoi::class);
    $app->post('/notConv', \GSA\Controller\NotationsConverter::class);
};