<?php

class Product
{
    var $name;
    var $price;

    function __construct($functionName, $functionPrice)
    {
        $this->name = $functionName;
        $this->price = $this->numberFormat($functionPrice);
    }

    public function numberFormat($price)
    {
       return number_format($price, 2);
    }
};