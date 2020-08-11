<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Factorial
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        if (is_numeric($request->getAttribute('number'))) {
            $number = $request->getAttribute('number');
            $factorial = $this->calcFactorial($number);
            $response->getBody()->write((string) $factorial);
            return $response;
        }
        $response->getBody()->write('Bad request');
        return $response;
    }
    
    private function calcFactorial(int $number): int
    {
        if ($number > 1) {
            return $number * $this->calcFactorial($number - 1);
        } 
        return 1;
    }
}
