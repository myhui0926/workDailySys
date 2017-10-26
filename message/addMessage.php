<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 14:50
 */
header('Content-Type=application/json;charset=UTF-8');
require '../mysqli_connect.php';
spl_autoload_register(function($_className){
    $path = str_replace("\\","/","../".$_className.".php");
    var_dump($path);
    exit();
    require "$path";
});
use \sys_interface\UserIn;
use \sys_class\User;
use \sys_class\message\Message;
use \sys_class\message\WorkDaily;
$user = new User();
$user->readUserInfo();
if ($_SERVER['REQUEST_METHOD']=='POST'){
    if ($_POST['type']=='workDaily'){
        $workdaily = new WorkDaily(0,$user->user_id,$_POST['primary'],$_POST['subject'],$_POST['html'],$mysqli);
        var_dump($workdaily);
        $res = $workdaily->addMessage($mysqli);
        echo json_encode($res);
    }
}

//$message = new Message(5,$user,'看视频学的比较快',$mysqli);
//var_dump($message);
//$res = $message->addMessage($mysqli);
//var_dump($res);