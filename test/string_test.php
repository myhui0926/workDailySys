<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 17:45
 */
$str = "宋朝辉啦啦啦";
$str2 = "abc456";
$str3 = "宋朝辉vffd啦啦啦abc";
$str4 = "abcdef";
echo strlen($str)."<br>";
echo strlen($str2)."<br>";
echo strlen($str3)."<br>";
echo strlen($str4)."<br>";
echo mb_strlen($str,'UTF-8')."<br>";
echo mb_strlen($str2,'UTF-8')."<br>";
echo mb_strlen($str3,'UTF-8')."<br>";
echo mb_strlen($str4,'UTF-8')."<br>";

echo mb_strcut($str3,0,10,'UTF-8');
echo mb_substr($str3,0,4,'UTF-8');