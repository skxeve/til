<?php
namespace App\Components;

/**
 * Adaptee 既存クラス
 */
class Banner
{
    private $string;

    public function __construct($str)
    {
        $this->string = $str;
    }

    public function showWithParen()
    {
        echo '(' . $this->string . ')';
    }

    public function showWithAster()
    {
        echo '*' . $this->string . '*';
    }
}
