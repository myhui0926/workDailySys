<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 13:14
 */
require "../mysqli_connect.php";
spl_autoload_register(function($className){
    $path = str_replace("\\","/","../".$className.".php");
    require "$path";
});
use \sys_class\User;
$user = new User();
$response = $user->login("songchaohui@hongzg.com","mypass333",$mysqli);
var_dump($user);
var_dump($response);