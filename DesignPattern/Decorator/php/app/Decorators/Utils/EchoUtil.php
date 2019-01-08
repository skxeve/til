<?php
namespace App\Decorators\Utils;

use App\Decorators\PlanDecorator;
use App\Interfaces\PlanInterface;

class EchoUtil extends PlanDecorator
{
    protected $title;

    public function __construct(PlanInterface $obj, $title)
    {
        parent::__construct($obj);
        $this->title = $title;
    }

    public function echoDuration()
    {
        self::echoLine();
        echo $this->title . PHP_EOL;
        if (method_exists($this->obj, 'getDuration')) {
            echo $this->obj->getDuration() . ' : ' . $this->obj->getPlan() . PHP_EOL;
        }
        echo PHP_EOL;
    }

    public function echoCost()
    {
        self::echoLine();
        echo $this->title . PHP_EOL;
        echo $this->obj->getPlan() . number_format($this->obj->getCost()) . PHP_EOL . PHP_EOL;
    }

    public static function echoLine($n = 50)
    {
        for ($i = 0; $i < $n; $i++) {
            echo '=';
        }
        echo PHP_EOL;
    }
}
