<?php
namespace App\Decorators;

use App\Interfaces\PlanInterface;

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
