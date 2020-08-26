<?php

// TODO:
//      get right regex for dots notation file content and use in ChooseNotation()
//

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotationsConverter
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        if (is_uploaded_file($_FILES['from']['tmp_name'])) {
            $filename = $_FILES['from']['tmp_name'];
        } else {
            $responseText = 'File "from" wasn\'t uploaded!';
        }
        $to = $request->getParsedBody()['to'];
        $array = $this->GetArrayToConvert($filename);
        $keys = array_keys($array);
        $array[$keys[0]] === 'Not found known notation!' ? $responseText = 'Not found known notation!' : $responseText = $this->GetNotationFromArray($array, $to);
        $response->getBody()->write($responseText);
        $response->header()->set ('Content-Type', 'text/xml');
        return $response;
    }

    private function GetArrayToConvert($filename) : array
    {
        $fileContent = file_get_contents($filename);
        // $fileContent = "a.b.c=1; a.b.d=2; a.c.e=3; a.c.f=4; b=5";
        $result = [];
        if ($this->ChooseNotation($fileContent) === 'dots') {
            $parts = explode(';', $fileContent);
            foreach ($parts as $part) {
                list($levels, $value) = $this->GetDotsPartLevels($part);
                $result = $this->updateBranch($result, $levels, $value);
            }
        } else {
            $result = ['Not found known notation!'];
        }
        return $result;
    }

    private function GetDotsPartLevels(string $text) : array
    {
        list($levelsString, $data) = explode('=', $text);
        $levelsString = trim($levelsString, ' ');
        $levels = explode('.', $levelsString);
        return [$levels, $data];
    }
    
    private function updateBranch(array $currentBranch, array $levels, string $value) : array
    {   
        $currentLevel = array_shift($levels);
        if (count($levels) > 0) {
            if (!array_key_exists($currentLevel, $currentBranch)) {
                $currentBranch[$currentLevel] = [];
            }
            $currentBranch[$currentLevel] = $this->updateBranch($currentBranch[$currentLevel], $levels, $value);
        }
        else {
            if (array_key_exists($currentLevel, $currentBranch)) {
                if (is_array($currentBranch[$currentLevel])) {
                    return [500, 'Bad request. Branch has a child branch!'];
                }
            }
            $currentBranch[$currentLevel] = $value;
        }
        return $currentBranch;
    }
        
    private function ChooseNotation(string $filename) : string
    {
        // $text = file_get_contents($filename);
        // return preg_match('/(((\w.?)+=\d+;)|((\w.?)+=\d+\Z))+/', $text, $this->fileParts);
        return 'dots';
    }

    private function GetNotationFromArray(array $toConvert, string $targetType) : string
    {
        if ($targetType === 'xml') {
            $resultContent = $this->GetFormatedBranch($toConvert, '<', '>', '</', '>');
        } else {
            $resultContent = 'Target type not found in available types!';
        }
        return $resultContent;
    }

    private function GetFormatedBranch(array $branches, string $openTagBegin, string $closeTagBegin, string $openTagEnd = '', string $closeTagEnd = '') : string
    {
        $resultContent = '';
        foreach ($branches as $key => $value) {
            $resultContent .= "$openTagBegin$key$closeTagBegin";
            if (gettype($value) === 'array') {
                $resultContent .= $this->GetFormatedBranch($value, $openTagBegin, $closeTagBegin, $openTagEnd, $closeTagEnd, '');
            } else {
                $resultContent .= $value;    
            }
            $resultContent .= "$openTagEnd$key$closeTagBegin";
        }
        return $resultContent;
    }
}