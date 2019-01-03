<?php
namespace App\Decorators\Packs;

use App\Decorators\PlanDecorator;
use App\Interfaces\PlanInterface;

class HotelPack extends PlanDecorator
{
    private $hotel_name;
    private $additional_cost = 0;

    public function __construct(PlanInterface $obj, $hotel_name, $additional_cost)
    {
        parent::__construct($obj);
        $this->hotel_name = $hotel_name;
        $this->additional_cost = $additional_cost;
    }

    public function getPlan()
    {
        return sprintf('%s / ホテルパック (%s) ', parent::getPlan(), $this->hotel_name);
    }

    public function getCost()
    {
        return parent::getCost() + $this->additional_cost;
    }
}
