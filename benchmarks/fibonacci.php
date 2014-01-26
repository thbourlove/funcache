<?php
require __DIR__."/../vendor/autoload.php";

use Funcache\Funcache;

$fib = function ($n) use (&$fib) {
    return ($n <= 3) ? $n : $fib($n - 1) + $fib($n - 2);
};
$start = microtime(true);
echo $fib(32)."\n";
echo microtime(true) - $start."\n";

$array = new ArrayIterator();
$fib = (new Funcache($array))->cacheOnArguments($fib, 'fib');
$start = microtime(true);
echo $fib(32)."\n";
echo microtime(true) - $start."\n";
