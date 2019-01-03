<?php
namespace App\Interfaces;

interface PlanInterface
{
    public function getPlan();
    public function setPlan($text);
    public function getCost();
    public function setCost($number);
}
