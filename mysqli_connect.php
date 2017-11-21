<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:18
 */
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_NAME','workdaily');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if ($mysqli->connect_error){
    echo "数据库连接错误：".$mysqli->connect_error;
    unset($mysqli);
}else{
    $mysqli->set_charset('utf8');
}

//面向对象的数据库查询：
//$mysqli->autocommit(false);
//$mysqli->begin_transaction(1,'register');
//$mysqli->query("INSERT INTO users (username, email, password,type,regis_date) VALUES
//    ('张三','zhangsan@hongzg.com',sha1('mypass333'),'normal',now())");
//if ($mysqli->affected_rows==1){
//    $mysqli->commit();
//    echo "执行成功";
//    $mysqli->autocommit(true);
//}else{
//    $mysqli->rollback();
//    echo "执行失败";
//}

//$mysqli->real_escape_string();

//$q = "SELECT username,email,type FROM users WHERE email='songchaohui@hongzg.com' AND password=sha1('mypass333')";
//$result = $mysqli->query($q);
//if ($result->num_rows==1){
//    var_dump($result->fetch_assoc());
//}else{
//    echo 'error';
//}
