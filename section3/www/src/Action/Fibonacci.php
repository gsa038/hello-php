<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Fibonacci
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        if (is_numeric($request->getAttribute('number'))) {
            $number = $request->getAttribute('number');
            $fibonacci = $this->calcFibonacci($number);
            $response->getBody()->write("$number $fibonacci");
            return $response;
        }
        $response->getBody()->write('Bad request');
        return $response;
    }
    
    private function calcFibonacci(int $number): int
    {
        if ($number > 1) {
            $fib = $this->calcFibonacci($number - 1) + $this->calcFibonacci($number - 2);
            return $fib;
        }
        return 1;
    }
}
