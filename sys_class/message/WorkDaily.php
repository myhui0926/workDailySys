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

    public function __construct($_parentID,UserIn $_user,$_primary,$_subject,$_html,$_mysqli)
    {
        parent::__construct($_parentID,$_user,$_primary,$_mysqli);//先执行父类的构造函数
        //验证数据合法性:
        $errors = array();
        if (isset($_subject) && !empty(trim($_subject)) && strlen(trim($_subject))<=36){
            $this->subject = $_mysqli->real_escape_string(trim(htmlentities($_subject,ENT_QUOTES,'UTF-8')));
        }else{
            $errors[] = "你没有输入标题或者标题内容超过12个汉子字符";
        }

        if (isset($_html) && !empty(trim($_html)) && strlen(trim($_html))<=10000){
            $this->html = $_mysqli->real_escape_string(htmlentities(trim($_html),ENT_QUOTES,'UTF-8'));
        }else{
            $errors[] = "你没有输入正文或者你输入的正文过长";
        }
        if (!empty($errors)){//如果存在错误
            self::$responseMsg['status'] = false;
            self::$responseMsg['errorMsg'][] = "内容验证没有通过：";
            foreach ($errors as $e){
                self::$responseMsg['errorMsg'][] = $e;
            }
        }
    }

    public static function viewDaily($_mid,$_mysqli){
        if(isset($_mid) && is_numeric($_mid)){
            $sql = "SELECT m1.message_id AS mid, m1.subject AS sbj,m1.`primary` AS pri,m1.html,count(m2.`primary`) AS num_reply
                    FROM message AS m1
                    LEFT JOIN message AS m2 ON m2.parent_id=m1.message_id
                    WHERE m1.message_id = $_mid AND m1.parent_id=0";
            $results = $_mysqli->query($sql);
            if ($results->num_rows==1){
               $row = $results->fetch_assoc();
               self::$responseMsg['msg'] = $row;
            }
            if(!$row['mid']){
                self::$responseMsg['status'] = false;
                self::$responseMsg['errorMsg'][] = "没有返回数据，请重试";
            }
        }else{
            self::$responseMsg['status'] = false;
            self::$responseMsg['errorMsg'][] = "参数错误，请重试";
        }
        return self::$responseMsg;
    }
}