<?php
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 2017/10/20
 * Time: 21:16
 */
header('Content-Type:application/json;charset=UTF-8');
require 'mysqli_connect.php';
spl_autoload_register(function($_className){//使用类自动加载模块
    $path = str_replace("\\","/",$_className.".php");
    require("$path");
});

$user = new \user\User();//新建一个user对象
$msg = $user->register('小林','xiaolin@hongzg.com','mypass333','mypass333','normal',$mysqli);
echo $msg;