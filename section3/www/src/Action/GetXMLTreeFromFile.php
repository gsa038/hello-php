<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SebastianBergmann\CodeCoverage\Report\Xml\Node as XmlNode;

class GetXMLTreeFromFile
{
    public array $fileParts;
    public array $result
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        $filename = $request->getAttribute('filename');
        if (file_exists($filename)) {
            if ($this->isValidFileForXML($filename)) {
                $xml = $this->getXMLfromParts($this->fileParts);
                $response->getBody()->write($this->$xml);
                return $response;
            }
        }
        return $response;
    }
    
    private function getXMLfromParts(array $fileParts): string
    {
        $tree = $this->buildPartsForArray($fileParts);
        $result = buildXML($tree);
        return $result;
    }
    
    private function buildPartsForArray(array $parts) : array
    {
        $result = [];
        foreach($parts as $i=>$part) {
            $result[$i] = $this->buildArrayFromPart($part);
        }
        return $result;
    }

    private function buildArrayFromPart(string $text) : array
    {
        list($data, $levelsString) = explode(';', $text);
        $levels = explode('.', $levelsString);
        $levelsTree = [];
        
        }
        
        foreach ($levels as $level) {
            $levelsTree = ();
        }

        return $result;
    }

    private function isValidFileForXML(string $filename) : bool
    {
        $text = file_get_contents($filename);
        return preg_match('/(((\w.?)+=\d+;)|((\w.?)+=\d+\Z))+/', $text, $this->fileParts);
    }
}
