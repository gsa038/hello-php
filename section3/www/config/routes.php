<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    $app->get('/hello/{yourName}', \App\Action\HomeAction::class);
    $app->get('/factorial/{number}', \App\Action\Factorial::class);
};