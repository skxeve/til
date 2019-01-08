<?php
require_once('vendor/autoload.php');

use App\Components\TravelPlan;
use App\Decorators\Utils\EchoUtil;
use App\Decorators\Packs\AirplanePack;
use App\Decorators\Packs\HotelPack;


$plan_base = new TravelPlan();
$plan_base->setPlan('沖縄');
$plan_base->setDuration('9/20 ~ 9/25');
(new EchoUtil($plan_base, '旅行プラン（ベース）'))->echoDuration();

$pack_plan_1 = new AirplanePack($plan_base, 'Composer航空', 50000);
(new EchoUtil($pack_plan_1, '旅行プラン１ 飛行機パック'))->echoCost();

$pack_plan_2 = new HotelPack($plan_base, 'Decoホテル', 67000);
(new EchoUtil($pack_plan_2, '旅行プラン２ ホテルパック'))->echoCost();

$pack_plan_3 = new HotelPack(
    new AirplanePack($plan_base, 'Composer航空', 50000),
    'Decoホテル',
    67000
);
(new EchoUtil($pack_plan_3, '旅行プラン３ 飛行機＋ホテルパック'))->echoCost();
