<?php
require __DIR__."/../vendor/autoload.php";

use Funcache\Funcache;

$miss = function () {
    return ;
};

$start = microtime(true);
for ($i = 0; $i < 100000; $i++) {
    $miss($i);
}
echo microtime(true) - $start."\n";

$array = new ArrayIterator();
$cacher = new Funcache($array);
$miss = $cacher->cacheOnArguments($miss, 'miss');
$start = microtime(true);
for ($i = 0; $i < 100000; $i++) {
    $miss($i);
}
echo microtime(true) - $start."\n";
