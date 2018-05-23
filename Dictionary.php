<?php

class Dictionary
{
    public $words = array();
    public $width = 2;
    public $height = 4;

    public function generateWorsByFile($fileName)
    {
        if ($file = fopen($fileName, 'r')) {
           while (($line[] = fgets($file)) !== false) {
                if (count($line) == $this->height ) {
                    for ($i=0; $i<=9; $i++) {
                        $dicInt = $i < 9 ? $i + 1 : $i = 10;
                        $this->words[$dicInt] = '';
                        for($row=0; $row <= $this->width; $row++) {
                            $this->words[$dicInt] .=
                            $line[$row][$this->width*$i]
                            .$line[$row][$this->width*$i+1]
                            .$line[$row][$this->width*$i+2];
                        }
                    }
                }
            }
            fclose($file);
        }

        $this->words = array_flip($this->words);
    }

    public function decodeFile(string $fileName)
    {
        if ($file = fopen($fileName, 'r')) {
            $word = '';
            while (($line = fgets($file)) !== false) {
                $linesTmp[] = $line;
                if (count($linesTmp) == $this->height ) {
                    for ($i=0; $i<=9; $i++) {
                        $wodrTmp = "";
                        for($row=0; $row <= $this->width; $row++) {
                            //  var_dump($linesTmp);
                               $wodrTmp .=
                                $linesTmp[$row][$this->width*$i]
                                .$linesTmp[$row][$this->width*$i+1]
                                .$linesTmp[$row][$this->width*$i+2];

                        }
                        if (isset($this->words[$wodrTmp])) {
                            $word .= $this->words[$wodrTmp];
                        } else {
                            $word .= '0';
                        }
                     }
                     $linesTmp = array();
                     $word.= ' ';
                 };
             }
             echo $word;
        }
    }
}

$dictonary = new Dictionary();
$dictonary->generateWorsByFile('dic.txt');
echo $dictonary->decodeFile('test2.txt');