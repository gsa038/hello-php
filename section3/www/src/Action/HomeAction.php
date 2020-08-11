<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeAction
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        if ($request->getAttribute('yourName')) {
            $name = $request->getAttribute('yourName');
        }
        else {
            $name = 'World';
        }
        $response->getBody()->write('Hello, ' . $name . '!');

        return $response;
    }
}