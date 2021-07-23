<?php
namespace App\Cook;

class JapaneseCook implements InterfaceCook
{
    public function makeSalad()
    {
        return "Gobo Salad";
    }

    public function makeMaindish()
    {
        return "Nikujaga";
    }
}
