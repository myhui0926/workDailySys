<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 13:49
 */
namespace sys_class\message;
use sys_interface\UserIn;
class WorkDaily extends Message
{
    public $subject = '';//添加主题属性值
    public function __construct($_parentID,UserIn $_userID,$_body,$_subject,$_mysqli)
    {
        parent::__construct($_parentID,$_userID,$_body,$_mysqli);//先执行父类的构造函数
        $this->subject = $_subject;
    }
}