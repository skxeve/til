<?php
namespace App\Components;

use App\Interfaces\PlanInterface;

class EchoPlan
{
    private $plan;
    private $name;
    public function __construct(PlanInterface $plan, $name)
    {
        $this->plan = $plan;
        $this->name = $name;
    }

    public function echoDuration()
    {
        self::echoLine();
        echo '旅行プラン' . $this->name . PHP_EOL;
        echo $this->plan->getDuration() . ' : ' . $this->plan->getPlan() . PHP_EOL . PHP_EOL;
    }

    public function echoCost()
    {
        self::echoLine();
        echo '旅行プラン' . $this->name . PHP_EOL;
        echo $this->plan->getPlan() . number_format($this->plan->getCost()) . PHP_EOL . PHP_EOL;
    }

    public static function echoLine($n = 50)
    {
        for ($i = 0; $i < $n; $i++) {
            echo '=';
        }
        echo PHP_EOL;
    }
}
