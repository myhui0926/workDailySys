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
    public $body = '';
    public $send_date = '';
    private static $responseMsg = array(//需要返回给用户的信息
        'status'=>true,
        'errorMsg'=>array(),
        'msg'=>array()
    );

    public function __construct($_parentID,UserIn $_userID,$_body,$_mysqli)//这里使用UserIn接口来限制函数的$_user参数必须是实现了UserIn接口的类的实例化对象
    {
        $errors = array();//用于存储出现的错误信息
        //验证数据的合法性，如果验证通过，将数据赋予实例相对应的属性值
        if (isset($_parentID) && is_numeric($_parentID)){
            $this->parent_id = (int) $_parentID;
        }else{
            $errors[] = "数据类型有误，请重试";
        }

        if (isset($_userID) && is_numeric($_userID)){
            $this->user_id = (int) $_userID;
        }else{
            $errors[] = "数据类型有误，请重试";
        }

        if (isset($_body) && is_string($_body) && mb_strlen($_body)<=1000){
            $this->body = $_mysqli->real_escape_string(trim(htmlentities($_body,ENT_COMPAT,'UTF-8')));

        }
    }

    public function addMessage($_mysqli)
    {
        //将数据插入到数据库
        $pid = $_mysqli->real_escape_string(trim($this->parent_id));
        $u = (int)
        $q = "INSERT INTO message (parent_id,user, subject, body, send_date) VALUES
  ($this->parent_id,$this->user->user_id,'$this->subject','$this->body',now())";

    }

    public function deleteMessage()
    {
        // TODO: Implement deleteMessage() method.
    }

    public function changeMessage()
    {
        // TODO: Implement changeMessage() method.
    }

    public function viewMessage()
    {
        // TODO: Implement viewMessage() method.
    }
}