<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 13:14
 */
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=UTF-8');
use \sys_class\User;
if ($_SERVER['REQUEST_METHOD']=='POST'){
    require "../mysqli_connect.php";
    spl_autoload_register(function($className){
        $path = str_replace("\\","/","../".$className.".php");
        require "$path";
    });
    if (isset($_POST['email']) && isset($_POST['pass'])){
        $response = User::login($_POST['email'],$_POST['pass'],$mysqli);
    }else{
        $response = array(
            "status"=>false,
            "errorMsg"=>"参数错误，请重试"
        );
    }
    echo json_encode($response);
}