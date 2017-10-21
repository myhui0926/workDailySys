<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 14:50
 */
require '../mysqli_connect.php';
spl_autoload_register(function($_className){
    $path = str_replace("\\","/","../".$_className.".php");
    require "$path";
});
use \sys_class\User;
use \sys_class\message\WorkDaily;
$user = new User();
$user->readUserInfo();
$workdaily = new WorkDaily(0,$user,"今天继续学习了PHPoop编程","宋朝辉10月21日工作日报");
var_dump($workdaily);