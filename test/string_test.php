<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 17:45
 */
$str = "宋朝辉啦啦啦";
$str2 = "abc456";
$str3 = "宋朝辉abc";
$str4 = "abcdef";
echo strlen($str)."<br>";
echo strlen($str2)."<br>";
echo strlen($str3)."<br>";
echo strlen($str4)."<br>";
echo mb_strlen($str,'UTF-8')."<br>";
echo mb_strlen($str2,'UTF-8')."<br>";
echo mb_strlen($str3,'UTF-8')."<br>";
echo mb_strlen($str4,'UTF-8')."<br>";

$variable = '';
if (empty($variable)){
    echo "YES";
}else{
    echo "NO";
}