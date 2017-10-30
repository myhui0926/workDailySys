<?php
$site_title="工作日报小demo-首页";
$page_css_list = array(
  "../css/mainpage.css"
);
$isActive = "index";
include '../public/site-header.php';
?>
<div class="container recentDaily">
    <div class="row block-title">
        <h2>我的工作汇报列表</h2>
    </div>
        <?php
        use sys_class\message\Message;
        $result = Message::viewMessage($user,$user->user_id,$mysqli);
        if ($result['status']){
            $daily_num = count($result['msg']);
            foreach ($result['msg'] as $key=>$m){
                if ($key%3==0){
                    echo '<div class="row block-content">';
                }
                    echo
                        '<div class="col-md-4">
                    <h3><span>'.($key+1).'</span>'.$m['sbj'].'</h3>
                    <p>'.$m['pri'].'<br></p>
                    <p><span>'.$m['reply_num'].'</span>条回复 <a href="viewDaily.php?mid='.$m['mid'].'">[查看全文]</a><a href="editDaily.php?mid='.$m['mid'].'">[编辑日报]</a></p>
                </div>';
                if (($key+1)%3==0 || ($key+1)==$daily_num){
                    echo '</div>';
                }
                }
        }
        ?>
</div>
    <div class="container view-underling">
        <div class="row vu-title">
            <h2>我直接管理的员工</h2>
        </div>
        <?php
        if (!empty($user->underling)){
            $ul_num = count($user->underling);
            foreach ($user->underling as $key => $ul){
                if ($key%3==0){
                    echo '<div class="row vu-list">';
                }
                echo '
                    <div class="col-md-4">
                <h3>'.$ul['name'].'</h3>
                <p>'.$ul['depart'].'</p>
                <p>'.$ul['email'].'</p>
                <p>'.$ul['type'].'</p>
                <p><a href="person-page.php?uid='.$user->user_id.'&viewUid='.$ul['uid'].'">查看</a></p>
            </div>
                ';
                if (($key+1)%3==0 || ($key+1)==$ul_num){
                    echo '</div>';
                }
            }
        }else{
            echo '<div class="row vu-list">你还没有直接管理的员工</div>';
        }
        ?>
    </div>
    <?php
        include '../public/site-footer.php';
    ?>
