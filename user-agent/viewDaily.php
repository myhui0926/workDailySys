<?php
$site_title="工作日报小demo-查看日报";
$page_css_list = array(
    "../css/viewDaily.css"
);
$isActive = "viewDaily";
include '../public/site-header.php';
use \sys_class\message\WorkDaily;
$res = WorkDaily::viewDaily($_GET['mid'],$mysqli);
if ($res['status']){
    $sbj = $res['msg']['sbj'];
    $pri = $res['msg']['pri'];
    $html = html_entity_decode($res['msg']['html']);
    $num_reply = $res['msg']['num_reply'];
}else{
    echo '<div class="container errorContent"><div class="row">';
    echo '<h2>系统错误，错误原因：</h2>';
    foreach ($res['errorMsg'] as $e){
        echo '<p>'.$e.'</p>';
    }
    echo '</div></div>';
    exit();
}
?>
<div class="container dailyContent">
    <div class="row">
        <h1>
            <?php echo $sbj ?>
        </h1>
    </div>
    <div class="row">
        <p><?php echo $pri ?></p>
    </div>
    <div class="row">
        <p><?php echo $html ?></p>
    </div>
    <div class="row">
        <p>
            <span><?php echo $num_reply ?></span>条回复
        </p>
    </div>
</div>
