<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 14:50
 */
namespace sys_interface;
interface UserIn
{
    public static function register($_username,$_email,$_type,$_department,$_group,$_password,$_confirmPass,$_dbc);//用户注册接口
    public static function login($_email,$_password,$_dbc);//用户登录接口
    public static function logout();
}