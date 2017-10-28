<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23
 * Time: 14:34
 */
require '../mysqli_connect.php';
spl_autoload_register(function ($className){
    $path = str_replace("\\","/","../".$className.".php");
    require "view_message.php";
});
use sys_class\message\Message;
use sys_class\User;
$user = new User();
$user->readUserInfo();
var_dump($user);
$result = Message::viewMessage($user,1,$mysqli);
var_dump($result);