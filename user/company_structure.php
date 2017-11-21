<?php
//header('Content-Type:application/json;charset=UTF-8');
require '../mysqli_connect.php';
spl_autoload_register(function($_className){
   $path = str_replace("\\","/","../".$_className.".php");
   require "$path";
});
use sys_class\User;
    $accept = User::companyStructure($mysqli);
    var_dump($accept);
        if ($accept['status']){//如果成功的返回了数据，则重新修改数据结构返回给客户端
            //返回的数组没有按照部门归类，因此需要重新修改数据结构，方便前端页面调用
            $response = array(
                'status'=>true,
                'errors'=>array(),
                'message'=>array()
            );
            $res_tmp =
                [
                    'did'=>0,
                    'dn'=>'',
                    'group'=>array()
                ];
            foreach ($accept['msg'] as $a){
                if ($res_tmp['did']==0){//说明是第一次遍历，需要初始化$res_tmp
                    $res_tmp['did'] = $a['did'];
                    $res_tmp['dn'] = $a['dn'];
                }
                if ($a['did']==$res_tmp['did']){//did相同，属于同一个部门，将小组加入数组中。
                    $res_tmp['group'][] = [
                        'gid'=>$a['gid'],
                        'gn'=>$a['gn']
                    ];
                }else{//did不一样，不同的部门，需要清空小组，重新添加。
                    $response['message'][] = $res_tmp;//现将数据存入最后需要返回的结果。
                    $res_tmp['did'] = $a['did'];//更改部门编号
                    $res_tmp['dn'] = $a['dn'];//更改部门名称
                    $res_tmp['group'] = array();//清空小组名称
                    $res_tmp['group'][] = [//重新将本次循环取出的小组的id和名称加入group二级数组
                        'gid' => $a['gid'],
                        'gn' => $a['gn']
                    ];
                }
            }
            echo json_encode($response);//返回json给客户端调用
        }else{
            //如果查询状态错误，直接将错误信息发送给客户端就可以了
            echo json_encode($accept);
        }
//}
