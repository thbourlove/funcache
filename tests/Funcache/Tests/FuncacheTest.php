<?php
namespace Funcache\Tests;

use Funcache\Funcache;

class FuncacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider callableProvider
     * */
    public function testFuncache($callable, $args, $result)
    {
        $cacher = new Funcache();
        $func = $cacher->cacheOnArguments($callable, 'call');
        $this->assertEquals(call_user_func_array($func, $args), $result);
    }

    public function callableProvider()
    {
        return array(
            array(
                function ($a) {
                    return $a;
                }, array(1), 1
            ),
            array(
                '\Funcache\Tests\b', array(1), 1
            ),
            array(
                '\Funcache\Tests\FuncacheTest::c', array(1), 1
            ),
        );
    }

    public static function c($a)
    {
        return $a;
    }
}

function b($a)
{
    return $a;
}
