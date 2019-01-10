<?php

class Cnt
{
    private static $obj = null;
    private $n = 0;
    private function __construct() {}

    public static function get()
    {
        if (self::$obj === null) {
            self::$obj = new Cnt();
        }
        return self::$obj;
    }

    public function incr()
    {
        return ++$this->n;
    }

    public function decr()
    {
        return --$this->n;
    }
}

$c1 = Cnt::get();
echo "c1 incr: " . $c1->incr() . PHP_EOL;
echo "c1 incr: " . $c1->incr() . PHP_EOL;

$c2 = Cnt::get();
echo "c2 incr: " . $c2->incr() . PHP_EOL;
