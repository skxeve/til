<?php
require_once('vendor/autoload.php');

use App\Components\HashContext;
use App\Components\Strategy\HashMd5;
use App\Components\Strategy\HashSha1;

if (isset($argv[1]) && $argv[1] == 'sha1') {
    echo 'strategy sha1' . PHP_EOL;
    $strategy = new HashSha1;
} else {
    echo 'strategy md5' . PHP_EOL;
    $strategy = new HashMd5;
}


$context = new HashContext($strategy);
var_dump($context->getHash('strategy design pattern.'));
