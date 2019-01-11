<?php
/**
 * Client
 * ここでは実行ファイル
 */
require_once('vendor/autoload.php');

use App\Components\OutputBanner;

$ob = new OutputBanner('Adapter DP');
echo '!outputWeak!' . PHP_EOL;
$ob->outputWeak();
echo PHP_EOL . PHP_EOL;

echo '!outputStrong!' . PHP_EOL;
$ob->outputStrong();
echo PHP_EOL . PHP_EOL;
