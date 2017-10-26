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
    public $html = '';//添加带有HTML标签的详情页属性值
    public function __construct($_parentID,UserIn $_userID,$_primary,$_subject,$_html,$_mysqli)
    {
        parent::__construct($_parentID,$_userID,$_primary,$_mysqli);//先执行父类的构造函数
        //验证数据合法性:
        $errors = array();
        if (isset($_subject) && strlen($_subject)<=36){
            $this->subject = $_mysqli->real_escape_string(trim(htmlentities($_subject,ENT_QUOTES,'UTF-8')));
        }else{
            $errors[] = "你没有输入标题或者标题内容超过12个汉子字符";
        }

        if (isset($_html) && mb_strlen($_html,'UTF-8')<=2000){
            $this->html = $_mysqli->real_escape_string(trim(htmlentities($_html,ENT_QUOTES,'UTF-8')));
        }else{
            $errors[] = "你没有输入正文或者你输入的正文超过6000个字符";
        }
        if (!empty($errors)){//如果存在错误
            self::$responseMsg['status'] = false;
            self::$responseMsg['errorMsg'][] = "内容验证没有通过：";
            foreach ($errors as $e){
                self::$responseMsg['errorMsg'][] = $e;
            }
        }
    }
}