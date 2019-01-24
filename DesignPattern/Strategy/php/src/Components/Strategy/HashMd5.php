<?php
namespace App\Components\Strategy;

use App\Interfaces\HashInterface;

class HashMd5 implements HashInterface
{
    public function getHash($str)
    {
        return md5($str);
    }
}
