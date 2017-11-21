<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1
 * Time: 10:25
 */

namespace sys_class;


class ViewedUser extends User
{
    public function __construct($_viewUid,$_mysqli)
    {
        if (isset($_viewUid) && is_numeric($_viewUid)){
            $sql = "SELECT u.user_id,u.depart_id,u.group_id,u.username,u.email,u.type,u.regis_date,d.name AS depart_name,g.name AS group_name
FROM users AS u INNER JOIN department AS d ON u.depart_id = d.depart_id
  LEFT JOIN `group` AS g ON u.group_id = g.group_id
WHERE user_id = $_viewUid";
            $result = $_mysqli->query($sql);
            if ($result->num_rows==1){
                $row = $result->fetch_assoc();
                $this->user_id = $row['user_id'];
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->type = $row['type'];
                $this->regis_date = $row['regis_date'];
                $this->depart = $row['depart_id'];
                $this->depart_name = $row['depart_name'];
                $this->group = $row['group_id'];
                $this->depart_name = $row['group_name'];
                $this->searchUnderling($_mysqli);
            }else{
                self::$responseMsg['status'] = false;
                self::$responseMsg['errors'][] = "没有返回数据";
            }
        }else{
            self::$responseMsg['status'] = false;
            self::$responseMsg['errors'][] = "参数错误，请重试";
        }
    }
}