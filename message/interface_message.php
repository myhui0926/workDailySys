<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:00
 */
interface Message
{
    public function readUserInfo();
    public function checkUserRights();
    public function addMessage();
    public function deleteMessage();
    public function changeMessage();
    public function viewMessage();
}