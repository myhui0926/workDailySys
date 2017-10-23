<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23
 * Time: 11:21
 */
spl_autoload_register(function($className){
    $path = str_replace("\\","/","../".$className.".php");
    require "$path";
});
use sys_class\User;
User::logout();
