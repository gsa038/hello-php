<? php

namespace App;

use Psr\Http\Message\ResponseInterface;
use Slim\ResponseEmitter as SlimResponseEmitter;

class factorial
{
    private $factorialNumber;

    public function __construct(int $factorialNumber)
    {
        this->$factorialNumber = $factorialNumber;
        parent::__construct($factorialNumber);
    }

    public function getFactorial(ResponseInterface $response): void{
        parent::getFactorial($response->)
    }
}