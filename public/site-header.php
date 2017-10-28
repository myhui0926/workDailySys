<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_title ?></title>
<script src="../lib/jquery-3.2.1.min.js"></script>
<script src="../lib/vue/vue.js"></script>
<link rel="stylesheet" href="../lib/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../lib/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<script src="../lib/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/site-header.css">
<?php
    foreach ($page_css_list as $pcl){
        echo '<link rel="stylesheet" href="'.$pcl.'">';//动态载入所需css资源
    }
    require "../mysqli_connect.php";
    spl_autoload_register(function($_className){
        $path = str_replace("\\","/",'../'.$_className.".php");
        require "$path";
    });
    use \sys_class\User;
    $user = new User();
    $user->readUserInfo();
?>
</head>
<body>
<nav  class="container c-nav">
    <div class="row">
        <ul class="col-md-3 nav nav-pills">
            <li role="presentation" class="<?php if($isActive == 'index') echo 'active' ?>"><a href="_index.php">个人首页</a></li>
            <li role="presentation"><a href="newDaily.html">新建日报</a></li>
            <?php
            if ($isActive=='viewDaily'){
                echo '<li role="presentation" class="active"><a href="viewDaily.php">查看日报</a></li>';
            }
            ?>
        </ul>
        <div class="col-md-5 col-md-offset-4">
            <div class="row user-info">
                <p class="col-md-4 col-md-offset-2">登录用户：
                    <a href="#"><?php echo $user->username; ?></a>
                </p>
                <a class="col-md-4" href="http://localhost/workDailySys/user/logout.php">退出登录</a>
            </div>
        </div>
    </div>
</nav>