<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \GSA\Controller\HomeAction::class);
    $app->get('/hello/{yourName}', \GSA\Controller\HomeAction::class);
    $app->get('/factorial/{number}', '\GSA\Controller\Factorial:getFactorial');
};