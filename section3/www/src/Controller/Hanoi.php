<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Hanoi
{
    public string $_hanoi = '';
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        $number = $request->getAttribute('number');
        if (is_numeric($number)) {
            if ($number > 0) {
                $A = new Rod('A', range($number, 1));
                $B = new Rod('B', []);
                $C = new Rod('C', []);
                $this->getHanoi($number, $A, $B, $C);
                $response->getBody()->write($this->_hanoi);
                return $response;
            }            
        }
        $response->getBody()->write('Bad request');
        return $response;
    }
    
    private function getHanoi(int $number, Rod $from, Rod $buf, Rod $to): void
    {
        if ($number > 0) {
            $this->getHanoi($number - 1, $from, $buf, $to );
            array_push($to, array_pop($from));
            $fromRodName = $from->_name;
            $toRodName = $to->_name;
            $this->_hanoi = $this->_hanoi . "disc $number from $fromRodName to $toRodName<br>";
            $this->getHanoi($number - 1, $buf, $to, $from);
        }
    }
}

class Rod
{
    public string $_name;
    public array $_data;
    public function __construct(string $name = null, array $data = null)
    {
        $this->_name = $name;
        $this->_data = $data;
    }
}