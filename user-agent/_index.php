<?php
$site_title="工作日报小demo-首页";
$page_css_list = array(
  "../css/mainpage.css"
);
include '../public/site-header.php';
?>
<div class="container recentDaily">
    <div class="row block-title">
        <h2>工作汇报列表</h2>
    </div>
        <?php
        use sys_class\message\Message;
        $result = Message::viewMessage($user,1,$mysqli);
//        var_dump($result);
//        var_dump(count($result['msg'],COUNT_NORMAL));
        if ($result['status']){
            $daily_num = count($result['msg']);
            foreach ($result['msg'] as $key=>$m){
                if ($key%3==0){
                    echo '<div class="row block-content">';
                }
                    echo
                        '<div class="col-md-4">
                    <h3><span>'.($key+1).'</span>'.$m['sbj'].'</h3>
                    <p>'.$m['bo'].'</p>
                    <p><span>3</span>条回复<a href="#">查看</a></p>
                </div>';
                if (($key+1)%3==0 || ($key+1)==$daily_num){
                    echo '</div>';
                }
                }
        }
include '../public/site-footer.php';
?>