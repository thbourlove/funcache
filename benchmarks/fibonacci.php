<?php
require __DIR__."/../vendor/autoload.php";

use Funcache\Funcache;

$timer = function ($func) {
    $start = microtime(true);
    echo $func(32)."\n";
    echo microtime(true) - $start."\n";
};

$fib = function ($n) use (&$fib) {
    return ($n <= 3) ? $n : $fib($n - 1) + $fib($n - 2);
};
$timer($fib);


$array = new ArrayIterator();
$cacher = new Funcache($array);
$fib = $cacher->cacheOnArguments($fib, 'fib');

$timer($fib);
