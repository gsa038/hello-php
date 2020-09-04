<?php

namespace GSA\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Factorial
{
    public function getFactorial(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        $number = $request->getAttribute('number');
        if (is_numeric($number) and $number >=0 ) {
                $factorial = $this->calcFactorial($number);
                $status = 200;
                $message = 'OK';
                $data = ['factorial' => $factorial];
        } else {
        $status = 400;
        $message = 'Bad request';
        }
        $responseData = ['statusCode' => $status, 'message' => $message, 'data' => $data];
        $payload = json_encode($responseData);
        $response->getBody()->write($payload);
        return $response->withStatus($status);
    }
    
    private function calcFactorial(int $number): int
    {
        if ($number > 1) {
            return $number * $this->calcFactorial($number - 1);
        } 
        return 1;
    }
}
