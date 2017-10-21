<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 9:31
 */

if (preg_match('/^\w{6,16}$/','fkiopl-')){
    echo "Yes";
}else{
    echo "Error";
}