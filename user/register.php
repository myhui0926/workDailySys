<?php
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/10/20
 * Time: 21:16
 */
header('Content-Type:application/json;charset=UTF-8');
require '../mysqli_connect.php';
spl_autoload_register(function($_className){//使用类自动加载模块
    $path = str_replace("\\","/","../".$_className.".php");
    var_dump($path);
    require("$path");
});
use \sys_class\User;//使用use导入命名空间下的类，省的实例化的时候再次带上命名空间，实现自动路由算法
$msg = User::register('啦啦啦','lalala@hongzg.com','mypass333','mypass333','normal',$mysqli);//后期从前台接收数据
var_dump($msg);