<?php
namespace App\Cook;

class AmericanCook implements InterfaceCook
{
    public function makeSalad()
    {
        return "chop salad";
    }

    public function makeMaindish()
    {
        return "steak";
    }
}
