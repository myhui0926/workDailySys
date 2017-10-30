<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:08
 */
namespace sys_class\message;
//使用use关键字结合命名空间，后期使用自动路由算法载入所需资源
use \sys_interface\MessageIn;
use \sys_interface\UserIn;
class Message implements MessageIn
{
    public $message_id = 0;
    public $parent_id = 0;
    public $user_id = 0;
    public $primary = '';
    public $send_date = '';
    protected static $responseMsg = array(//需要返回给用户的信息
        'status'=>true,
        'errorMsg'=>array(),
        'msg'=>array()
    );

    public function __construct($_parentID,UserIn $_user,$_primary,$_mysqli)//这里使用UserIn接口来限制函数的$_user参数必须是实现了UserIn接口的类的实例化对象
    {
        $errors = array();//用于存储出现的错误信息
        //验证数据的合法性，如果验证通过，将数据赋予实例相对应的属性值
        if (isset($_parentID) && is_numeric($_parentID)){
            $this->parent_id = (int) $_parentID;
        }else{
            $errors[] = "数据类型有误，请重试";
        }

        if (isset($_user->user_id) && is_numeric($_user->user_id)){
            $this->user_id = (int) $_user->user_id;
        }else{
            $errors[] = "数据类型有误，请重试";
        }

        if (isset($_primary) && !empty(trim($_primary)) && mb_strlen($_primary,'UTF-8')<1000){
            $this->primary = $_mysqli->real_escape_string(htmlentities(trim($_primary),ENT_COMPAT,'UTF-8'));
        }else{
            $errors[] = "你没有输入内容或者输入内容超过1000个字符";
        }

        if (!empty($errors)){//如果存在错误
            self::$responseMsg['status'] = false;
            self::$responseMsg['errorMsg'][] = "内容验证没有通过：";
            foreach ($errors as $e){
                self::$responseMsg['errorMsg'][] = $e;
            }
        }
    }

    public function addMessage($_mysqli)
    {
        if (self::$responseMsg['status']){
            //将数据插入到数据库
            $pid = $this->parent_id;
            $uid = $this->user_id;
            $pri = $this->primary;
            if (isset($this->subject)){
                $sbj = $this->subject;
            }else{
                $sbj = null;
            }
            if (isset($this->html)){
                $html = $this->html;
            }else{
                $html = null;
            }
            $sql = "INSERT INTO message (parent_id, user, subject, `primary`, html, send_date) VALUES ($pid,$uid,'$sbj','$pri','$html',now())";
            $_mysqli->autocommit(false);
            $_mysqli->begin_transaction();
            $_mysqli->query($sql);
            if ($_mysqli->affected_rows==1){
                $_mysqli->commit();
                $_mysqli->autocommit(true);
                self::$responseMsg['msg'][] = "提交成功";
            }else{
                $_mysqli->rollback();
                self::$responseMsg['status'] = false;
                self::$responseMsg['errorMsg'][] = "系统错误，提交失败，请重试";
            }
        }
        return self::$responseMsg;
    }

    public function deleteMessage()
    {
        // TODO: Implement deleteMessage() method.
    }

    public function changeMessage()
    {
        // TODO: Implement changeMessage() method.
    }

    public static function viewMessage(UserIn $_user,$_viewUid,$_mysqli)
    {
        // TODO: Implement viewMessage() method.
        if (isset($_user->user_id) && is_numeric($_user->user_id) && isset($_viewUid) && is_numeric($_viewUid)){
            $sql = "SELECT m1.message_id AS mid, m1.subject AS sbj ,m1.`primary` AS pri ,count(m2.`primary`) AS reply_num
FROM message AS m1 LEFT JOIN message AS m2 ON m2.parent_id = m1.message_id
WHERE m1.user = $_user->user_id AND m1.parent_id=0 GROUP BY m1.message_id";
            $result = $_mysqli->query($sql);
            if ($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    self::$responseMsg['msg'][] = $row;
                }
            }
        }else{
            self::$responseMsg['status'] = false;
            self::$responseMsg['errorMsg'][] = "用户身份验证失败，请重新登录";
        }
        return self::$responseMsg;
    }
}