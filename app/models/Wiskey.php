<?php

namespace PHPBootcamp\Models;

class Wiskey
{
    public function __construct()
    {
        $this->arrayOfWiskey = [
            'Rye',
            'Corn',
            'Bourbon',
            'Single Pot Still',
            'Blended',
            'Grain',
            'Malt'
        ];
    }

    public function getRandomWiskey() :string
    {
        $arrayLenght = count($this->arrayOfWiskey);
        $randWiskeyKey = rand(0, $arrayLenght-1);
        $randomWiskeyName = $this->arrayOfWiskey[$randWiskeyKey];

        return $randomWiskeyName;
    }
}