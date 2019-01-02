<?php

interface PlanInterface
{
    public function getPlan();
    public function setPlan($text);
    public function getCost();
    public function setCost($number);
}

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

abstract class PlanDecorator implements PlanInterface
{
    private $obj;

    public function __construct(PlanInterface $obj)
    {
        $this->obj = $obj;
    }

    public function getPlan()
    {
        return $this->obj->getPlan();
    }

    public function setPlan($text)
    {
        $this->obj->setPlan($text);
    }

    public function getCost()
    {
        return $this->obj->getCost();
    }

    public function setCost($number)
    {
        $this->obj->setCost($this->getCost() + $number);
    }
}


