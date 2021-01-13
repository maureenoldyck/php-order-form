<?php

class Product
{
    var $name;
    var $price;

    function __construct($functionName, $functionPrice)
    {
        $this->name = $functionName;
        $this->price = $functionPrice;
    }

    function numberFormat($price)
    {
        $this->price = number_format($price, 2);
    }
};