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
use \sys_class\message\Message;
use \sys_class\message\WorkDaily;
$user = new User();
$user->readUserInfo();
//$workdaily = new WorkDaily(0,$user,"做了新系统的设计统筹工作","10月30日赵丹日报",$mysqli);
//var_dump($workdaily);
//$res = $workdaily->addMessage($mysqli);
//var_dump($res);

$message = new Message(5,$user,'看视频学的比较快',$mysqli);
var_dump($message);
$res = $message->addMessage($mysqli);
var_dump($res);