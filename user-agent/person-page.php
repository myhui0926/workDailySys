<?php
use \sys_class\ViewedUser;
use \sys_class\message\Message;
$site_title="工作日报小demo-用户主页";
$page_css_list = array(
    "../css/mainpage.css"
);
$isActive = "viewPersonPage";
include '../public/site-header.php';
$check = false;//默认权限验证状态
foreach ($user->underling as $ul){
    if ($ul['uid']==$_GET['viewUid']){
        $check = true;
    }
}
    if ($check){
    $viewedUser = new ViewedUser($_GET['viewUid'],$mysqli);
    var_dump($viewedUser);
        echo '
            <div class="container recentDaily">
            <div class="row block-title">
                <h2>'.$viewedUser->username.'的工作汇报列表</h2>
            </div>
        ';
        $result = Message::viewMessage($user,$viewedUser->user_id,$mysqli);
        if ($result['status']){
            $daily_num = count($result['msg']);
            foreach ($result['msg'] as $key=>$m){
                if ($key%3==0){
                    echo '<div class="row block-content">';
                }
                echo
                    '<div class="col-md-4">
                    <h3><span>'.($key+1).'</span>'.$m['sbj'].'</h3>
                    <p>'.mb_strcut($m['pri'],0,300,'UTF-8').'...<br></p>
                    <p><span>'.$m['reply_num'].'</span>条回复<a href="viewDaily.php?mid='.$m['mid'].'">[查看全文]</a></p>
                </div>';
                if (($key+1)%3==0 || ($key+1)==$daily_num){
                    echo '</div>';
                }
            }
        }
        echo '</div>';

        echo '<div class="container view-underling">
        <div class="row vu-title">
            <h2>'.$viewedUser->username.'直接管理的员工</h2>
        </div>';
        if (!empty($viewedUser->underling)){
            $ul_num = count($viewedUser->underling);
            foreach ($viewedUser->underling as $key => $ul){
                if ($key%3==0){
                    echo '<div class="row vu-list">';
                }
                echo '
                    <div class="col-md-4">
                <h3>'.$ul['name'].'</h3>
                <p>'.$ul['depart'].'</p>
                <p>'.(empty($ul['group']) ? '没有分组' : $ul['group']).'</p>
                <p>'.$ul['email'].'</p>
                <p>'.$ul['type'].'</p>
                <p><a href="person-page.php?uid='.$user->user_id.'&viewUid='.$ul['uid'].'">查看</a></p>
            </div>
                ';
                if (($key+1)%3==0 || ($key+1)==$ul_num){
                    echo '</div>';
                }
            }
        }
        echo '</div>';
    }else{
        echo '<p class="text-center text-danger">你没有读取此用户工作汇报的权限</p>';
    }

include '../public/site-footer.php';