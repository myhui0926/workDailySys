<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21
 * Time: 13:51
 */

namespace message;
require 'Message.php';

class UserReplay extends Message
{
    public $replayTo = 0;
}