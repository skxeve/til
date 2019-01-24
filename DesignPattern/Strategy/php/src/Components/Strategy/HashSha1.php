<?php
namespace App\Components\Strategy;

use App\Interfaces\HashInterface;

class HashSha1 implements HashInterface
{
    public function getHash($str)
    {
        return sha1($str);
    }
}
