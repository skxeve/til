<?php
require_once('vendor/autoload.php');

use App\Components\TravelPlan;
use App\Decorators\Packs\AirplanePack;
use App\Decorators\Packs\HotelPack;

$plan_base = new TravelPlan();
$plan_base->setPlan('沖縄');
$plan_base->setDuration('9/20 ~ 9/25');

echo '旅行プラン（ベース）'.PHP_EOL;
echo $plan_base->getDuration() . ' : ' . $plan_base->getPlan() . PHP_EOL . PHP_EOL;

$pack_plan_1 = new AirplanePack($plan_base, 'Composer航空', 50000);
echo '旅行プラン１ 飛行機パック' . PHP_EOL;
echo $pack_plan_1->getPlan() . number_format($pack_plan_1->getCost()) . PHP_EOL . PHP_EOL;

$pack_plan_2 = new HotelPack($plan_base, 'Decoホテル', 67000);
echo '旅行プラン２ ホテルパック' . PHP_EOL;
echo $pack_plan_2->getPlan() . number_format($pack_plan_2->getCost()) . PHP_EOL . PHP_EOL;


echo '旅行プラン３ 飛行機＋ホテルパック' . PHP_EOL;
$pack_plan_3 = new HotelPack(
    new AirplanePack($plan_base, 'Composer航空', 50000),
    'Decoホテル',
    67000
);
echo $pack_plan_3->getPlan() . number_format($pack_plan_3->getCost()) . PHP_EOL . PHP_EOL;

