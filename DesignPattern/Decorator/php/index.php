<?php
require_once('vendor/autoload.php');

use App\Components\TravelPlan;
use App\Components\EchoPlan;
use App\Decorators\Packs\AirplanePack;
use App\Decorators\Packs\HotelPack;


$plan_base = new TravelPlan();
$plan_base->setPlan('沖縄');
$plan_base->setDuration('9/20 ~ 9/25');

(new EchoPlan($plan_base, '（ベース）'))->echoDuration();

$pack_plan_1 = new AirplanePack($plan_base, 'Composer航空', 50000);
(new EchoPlan($pack_plan_1, '１ 飛行機パック'))->echoCost();

$pack_plan_2 = new HotelPack($plan_base, 'Decoホテル', 67000);
(new EchoPlan($pack_plan_2, '２ ホテルパック'))->echoCost();

$pack_plan_3 = new HotelPack(
    new AirplanePack($plan_base, 'Composer航空', 50000),
    'Decoホテル',
    67000
);
(new EchoPlan($pack_plan_3, '３ 飛行機＋ホテルパック'))->echoCost();
