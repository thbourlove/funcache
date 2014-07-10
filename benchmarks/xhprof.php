<?php
require __DIR__."/../vendor/autoload.php";

use Funcache\Funcache;

$miss = function () {
    return ;
};

$cacher = new Funcache();
$miss = $cacher->cacheOnArguments($miss, 'miss');
$mongo = new MongoClient();
$xhprof = new \Thb\Xhgui\Extension($mongo->xhprof);
$xhprof->start();
for ($i = 0; $i < 100000; $i++) {
    $miss($i);
}
$xhprof->save('funcache');
