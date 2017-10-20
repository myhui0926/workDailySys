<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:18
 */

$dbc = new mysqli('localhost','root','root','workdaily');

if (mysqli_connect_error()){
    echo "连接数据库失败：".mysqli_connect_error();
    exit();
}
$dbc->set_charset('utf8');
