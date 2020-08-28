<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetXMLTreeFromFile
{
    public array $fileParts;
    public array $result;

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
        // $result = buildXML($tree);
        $result = 'ok';
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

    private function buildArrayFromPart(string $text) : Tree
    {
        list($data, $levelsString) = explode('=', $text);
        $levels = explode('.', $levelsString);
        $tree = $this->buildTree(null, $levels, $data);
        return $tree;
    }

    private function buildTree(Tree $_tree = null, array $_levels, string $data) : Tree
    {
        $levels = $_levels;
        $tree = $_tree;
        if ($tree === null) {
            $tree = new Tree();
        }
        if (count($levels) > 1) {
            $tree->level = $levels[0];
            $levels = array_shift($levels);
            $tree->next = $this->buildTree($tree, $levels, $data);
        }
        else {
            $tree->data = $data;
        }
        return $tree;
    }
        
    private function isValidFileForXML(string $filename) : bool
    {
        // $text = file_get_contents($filename);
        $text = 'a.b.c=1; a.b.d=2; a.c.e=3; a.c.f=4; b=5';
        return preg_match('/(\w\.?)+=(\d+;|\d+)\s*/';
        $this->fileParts = explode(';', $text); 
        return true;
    }
}

class Tree {
    public array $data;
    public string $level;
    public Tree $next;
    
    public function __construct()
    {
        $this->head = null;
    }
}
