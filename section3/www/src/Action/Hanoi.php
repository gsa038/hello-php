<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Hanoi
{
    public string $hanoi;
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        global $hanoi;
        $number = $request->getAttribute('number');
        if (is_numeric($number)) {
            if ($number > 0) {
                $A = range($number, 1);
                $B = [];
                $C = [];
                $hanoi = '';
                $this->getHanoi($hanoi, $number, $A, $B, $C);
                $response->getBody()->write($hanoi);
                return $response;
            }            
        }
        $response->getBody()->write('Bad request');
        return $response;
    }
    
    private function getHanoi(string $hanoi = null, int $number, array $from = [], array $buf = [], array $to = []): void
    {
        if ($number > 0) {
            $this->getHanoi($hanoi, $number - 1, $from, $buf, $to );
            array_push($to, array_pop($from));
            $source = implode('-', $from);
            $destination = implode('-', $to);
            $hanoi = $hanoi . "disc $number from [$source] to [$destination]\n";
            $this->getHanoi($hanoi, $number - 1, $buf, $to, $from);
        }
    }
}
