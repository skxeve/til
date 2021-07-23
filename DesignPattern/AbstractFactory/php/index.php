<?php
require_once('vendor/autoload.php');

use App\Cook\InterfaceCook;
use App\Cook\JapaneseCook;
use App\Cook\AmericanCook;
use App\Cook\FakeCook;


$cooks = [new JapaneseCook, new AmericanCook, new FakeCook];

foreach ($cooks as $cook) {
    if ($cook instanceof InterfaceCook) {
        print get_class($cook)." implemets InterfaceCook.".PHP_EOL;
        print $cook->makeSalad().PHP_EOL;
        print $cook->makeMaindish().PHP_EOL;
    } else {
        print get_class($cook)." is unexpected cook?????".PHP_EOL;
    }
}
