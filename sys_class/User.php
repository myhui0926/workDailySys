<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:07
 */

namespace sys_class;
use \sys_interface\UserIn;//使用use关键字，避免实现接口时带上命名空间,并在后期实现自动路由算法计算所需文件路径
class User implements UserIn
{
    public $user_id = '';
    public $username = '';
    public $email = '';
    public $type = 'normal';
    public $regis_date = '';
    private static $responseMsg = array(//用于和前台传递数据
        'status'=>true,
        'errors'=>array(),
        'msg'=>array()
    );

    public static function register($_username,$_email,$_password,$_confirmPass,$_type,$_mysqli)
    {
        $errors = array();//存储错误数据
        // TODO: Implement register() method.
        if (isset($_username) && preg_match('/^[\x{4e00}-\x{9fa5}]{2,5}$/u',$_username)){
            $un = $_mysqli->real_escape_string(trim(htmlentities($_username,ENT_COMPAT,'UTF-8')));
        }else{
            $errors[] = "请输入合法的用户姓名（3-5个汉字）";
        }

        if (isset($_email) && preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$_email)){
            $em = $_mysqli->real_escape_string(trim(strip_tags($_email)));
        }else{
            $errors[] = "请输入合法的邮箱地址";
        }

        if (isset($_password) && preg_match('/\w{6,16}/',$_password)){
            if ($_password==$_confirmPass){
                $p = $_mysqli->real_escape_string(trim($_password));
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
            $_mysqli->autocommit(false);//开始事务
            $_mysqli->begin_transaction();
            $_mysqli->query($q);
            if ($_mysqli->affected_rows==1){
                $_mysqli->commit();
                self::$responseMsg['msg'][] = "注册成功";
                $_mysqli->autocommit(true);//重新开启自动提交
            }else{
                $_mysqli->rollback();
                self::$responseMsg['status'] = false;
                self::$responseMsg['errors'][] = "注册失败，系统错误。";
            }
        }else{
            self::$responseMsg['status'] = false;
            foreach ($errors as $e){
                self::$responseMsg['errors'][] = $e;
            }
        }
        return self::$responseMsg;
    }

    public function login($_email,$_passwprd,$_mysqli)
    {
        $errors = array();
        if (isset($_email) && preg_match("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/",$_email)){
            $em = $_mysqli->real_escape_string(trim($_email));
        }else{
            $errors[] = "请输入合法的电子邮件地址";
        }

        if (isset($_passwprd) && preg_match("/^\w{6,16}$/",$_passwprd)){
            $pa = $_mysqli->real_escape_string(trim($_passwprd));
        }else{
            $errors[] = "请输入合法的密码";
        }

        if (empty($errors)){
            $q = "SELECT user_id,username,email,type, regis_date FROM users WHERE email='$em' AND password=sha1('$pa')";
            $result = $_mysqli->query($q);
            if ($result->num_rows==1){
                $row = $result->fetch_assoc();//取出数据
                //取出的数据放入实例会话中
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['type'] = $row['type'];
                $_SESSION['regis_date'] = $row['regis_date'];
                self::$responseMsg['msg'][] = "登录成功";
            }else{
                self::$responseMsg['status'] = false;
                self::$responseMsg['errors'] = "用户名或密码错误";
            }
        }else{
            self::$responseMsg['status'] = false;
            foreach ($errors as $e){
                self::$responseMsg['errors'][] = $e;
            }
        }
        return self::$responseMsg;
    }

    public function readUserInfo()
    {
        // TODO: Implement readUserInfo() method.
        session_start();
        if (!isset($_SESSION['user_id'])){
            //如果会话中没有用户信息，重定向用户到登录页面
            self::redirect_user('user/login.php');
        }else{
            //登录成功后，将会话中存储的信息设置为实例的属性：
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->email = $_SESSION['email'];
            $this->type = $_SESSION['type'];
            $this->regis_date = $_SESSION['regis_date'];
        }
    }
    private static function redirect_user($_path='index.php'){
        //用于自动重定向用户页面
        $url = 'http://'.$_SERVER['HTTP_HOST']."/workDailySys/".$_path;
        var_dump($url);
        header("Location:$url");
        exit();
    }
}