<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 14:50
 */
interface User
{
    public function register($_username,$_email,$_password,$_confirmPass,$_type,$_dbc);//用户注册接口
    public function login($_email,$_password);//用户登录接口
    public function sendMessage();//发送消息接口(发送日报、回复)
    public function viewMessage();//查看消息接口
    public function deleteMessage();//删除消息接口
}