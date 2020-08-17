<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetXMLTreeFromFile
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        $filename = $request->getAttribute('filename');
        if (isValidXMLFile($filename)) {
            $xmlTree = getXMLTree();
            $response->getBody()->write($this->$xmlTree);
            return $response;
        }
        return $response;
    }
    
    private function getXMLTree(string $filename): stirng
    {
        $text = file_get_contents($filename);
        if ($number > 0) {
            $this->getHanoi($number - 1, $from, $buf, $to );
            array_push($to, array_pop($from));
            $fromRodName = $from->_name;
            $toRodName = $to->_name;
            $this->_hanoi = $this->_hanoi . "disc $number from $fromRodName to $toRodName<br>";
            $this->getHanoi($number - 1, $buf, $to, $from);
        }
    }

    private function getXmlPartsFromString(string $text) : array
    {
        $result = explode(';', $text);
        return $result;
    }

    private function isValidXMLFile(string $filename) : bool
    {
        if (file_exists($filename)) {
            $text = file_get_contents($filename);
            return preg_match('/(((\w.?)+=\d+;)|((\w.?)+=\d+\Z))+/', $text);
        }
        return false;
    }
}