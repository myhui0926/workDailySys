<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 13:56
 */

namespace test;
require 'testInterface.php';
use \test\Test as T;
class TestClass implements T
{
    public function sayHi()
{
    // TODO: Implement sayHi() method.
    echo "Hello,world!";
}
}

$test = new TestClass();
$test->sayHi();