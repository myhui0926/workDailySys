<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:07
 */

namespace user;
require 'interface_user.php';
class User implements \User
{
    public $username = '';
    public $email = '';
    public $password = '';
    public $type = 'normal';
    public $regis_date = '';

    public function register($_username,$_email,$_password,$_confirmPass,$_type,$_dbc)
    {
        $responseMsg = array(//返回给用户的数据
            'status'=>true,
            'errors'=>array(),
            'msg'=>array()
        );
        $errors = [];//存储错误数据
        // TODO: Implement register() method.
        if (isset($_username) && preg_match('/^[\x{4e00}-\x{9fa5}]{2,5}$/u',$_username)){
            $un = $_dbc->real_escape_string(trim(htmlentities($_username,ENT_COMPAT,'UTF-8')));
        }else{
            $errors[] = "请输入合法的用户姓名（3-5个汉字）";
        }

        if (isset($_email) && preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$_email)){
            $em = $_dbc->real_escape_string(trim(strip_tags($_email)));
        }else{
            $errors[] = "请输入合法的邮箱地址";
        }

        if (isset($_password) && preg_match('/\w{6,16}/',$_password)){
            if ($_password==$_confirmPass){
                $p = $_dbc->real_escape_string(trim($_password));
            }else{
                $errors[] = "你两次输入的密码不匹配，请重新输入";
            }
        }else{
            $errors[] = "请输入6-16位合法的密码(数字、字母、下划线)";
        }

        if (isset($_type) && ($_type=='normal' || $_type=='group' || $_type=='department' || $_type=='boss')){
                $ty = $_type;
            }else{
            $errors[] = "你的用户类型有误";
        }

        if (empty($errors)){//所有验证都通过
            $q = "INSERT INTO users (username, email, password,type,regis_date) VALUES
    ('$un','$em',sha1('$p'),'$ty',now())";
            $_dbc->autocommit(false);//开始事务
            $_dbc->begin_transaction();
            $_dbc->query($q);
            if ($_dbc->affected_rows==1){
                $_dbc->commit();
                $responseMsg['msg'][] = "注册成功";
                $_dbc->autocommit(true);//重新开启自动提交
            }else{
                $_dbc->rollback();
                $responseMsg['status'] = false;
                $responseMsg['errors'][] = "注册失败，系统错误。";
            }
        }else{
            $responseMsg['status'] = false;
            foreach ($errors as $e){
                $responseMsg['errors'][] = $e;
            }
        }

        echo json_encode($responseMsg);

    }

    public function login($_email,$_passwprd)
    {
        // TODO: Implement login() method.
    }

    public function sendMessage()
    {
        // TODO: Implement sendMessage() method.
    }

    public function viewMessage()
    {
        // TODO: Implement viewMessage() method.
    }

    public function deleteMessage()
    {
        // TODO: Implement deleteMessage() method.
    }
}