<?php
namespace App\Components;

use App\Interfaces\PlanInterface;

class TravelPlan implements PlanInterface
{
    private $plan;
    private $cost = 0;
    private $duration;

    public function getPlan()
    {
        return $this->plan;
    }

    public function setPlan($text)
    {
        $this->plan = $text;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($number)
    {
        $this->cost = $number;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
}
