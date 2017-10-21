<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 15:00
 */
namespace sys_interface;
interface MessageIn
{
    public function addMessage($_mysqli);
    public function deleteMessage();
    public function changeMessage();
    public function viewMessage();
}