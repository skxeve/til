<?php
namespace App\Components;

use App\Interfaces\HashInterface;

class HashContext
{
    private $strategy;

    public function __construct(HashInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function getHash($str)
    {
        return $this->strategy->getHash($str);
    }
}
