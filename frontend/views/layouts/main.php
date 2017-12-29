<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use backend\assets\MaterialAsset;
use ramosisw\CImaterial\web\MaterialAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\web\View;

Yii::$app->name = 'ONBAZNAS';
MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    .form-group{margin:10px 0px 10px 0px;}
    .dropdown-menu > a {margin: 0px}
    .collapse .nav {margin: -5px 0 0px 0px; padding-bottom: 10px}
    .sidebar .nav li.active>[data-toggle=collapse] i{color:#fff}
    .sidebar .nav li.active>[data-toggle=collapse] p{color:#fff}
    .in{background: #fff}
    .in > .in{background: #eee}
    .in > .in > .in{background: #efe}
    .in > .in > .in > .in{background: #ffe}
    .collapse ul li a > i {margin-top:5px}
    .filters td > .form-group{margin:0}
    .filters > td {padding:0}
    .h1,.h2,.h3,h1,h2,h3{margin-top:0px; margin-left:-2px;}
    ul.breadcrumb{padding: 3px; margin-top: 13px; margin-left: 13px; background: none; font-size: 13px}
    /*@media (max-width: 480px) {
        ul.breadcrumb{margin-left: 13px; margin-top: -17px; padding: 2px; min-width:300px}
    }*/
    h1{font-size: 40px}
    .summary{margin-left: 10px;}
    .glyphicon{padding: 5px 5px 5px 5px}
    .glyphicon:hover{background: #9C27B0; color:#fff; border-radius: 50%;}
    .card .table{margin-bottom: 10px}
    .file-caption-name{margin:20px 0 0 30px}
    .modal modal-dialog{margin-top: 0px}
    .card .nav-pills{margin-top: 10px}
    .nav-center{padding: 0}
    </style>
</head>
<body class="bootstrap-collapse ">
    <?php $this->beginBody() ;
    $this->registerJs('
        $("input[togglebutton=\"true\"]").parent().parent().addClass("togglebutton");
        $("input[type=\"radio\"]").click(function(){
            $(this).parent().parent().parent().find("input[type=\"radio\"]").attr("checked", false);
            $(this).attr("checked", true);
        });
        ', View::POS_END);
    ?>
    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="<?= Url::to('@web/img/sidebar-1.jpg') ?>">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
            Tip 2: you can also add an image using data-image tag
            -->
            <div class="logo">
                <a href="<?= Url::toRoute(['pengumuman']) ?>" class="simple-text"><?= Html::encode(Yii::$app->name) ?></a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <?=  \common\widgets\SideNav::widget(['items' => require '_item_auth.php',]) ?>
                </div>
                <?=  \common\widgets\SideNav::widget(['items' => require '_item_menu.php',]) ?>
                <!-- ul disini -->
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button class="btn btn-round btn-white btn-fill btn-just-icon" id="minimizeSidebar">
                            <i class="visible-on-sidebar-regular fa fa-list"></i>
                            <i class="visible-on-sidebar-mini fa fa-list"></i>
                        <div class="ripple-container"></div></button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--<a class="navbar-brand" href="#"><?= $this->title ?></a>-->
                        <div class="pull-left" >
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        </div>     
                        
                    </div>
                    <?php if(!Yii::$app->user->isGuest){ ?>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?= Url::toRoute(['pengumuman']) ?>" >
                                    <i class="material-icons">home</i>
                                    <p class="hidden-lg hidden-md">Home</p>
                                </a>
                            </li>
                            <!--<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Mike John responded to your email</a></li>
                                    <li><a href="#">You have 5 new tasks</a></li>
                                    <li><a href="#">You're now friend with Andrew</a></li>
                                    <li><a href="#">Another Notification</a></li>
                                    <li><a href="#">Another One</a></li>
                                </ul>
                            </li>-->
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   <i class="material-icons">person</i>
                                   <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= Url::toRoute(['/admin/user/change-password'])?>">Change Password</a></li>
                                    <li><a href="<?= Url::toRoute(['site/logout'])?>" data-method="post">Log Out</a></li>                                    
                                </ul>                                
                            </li>
                        </ul>

                        <!--<form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i><div class="ripple-container"></div>
                            </button>
                        </form>-->
                    </div>
                    <?php } ?>
                </div>
            </nav>

            <div class="content" style="margin-top: 35px; margin-bottom: -15px">
                
                <?= Alert::widget() ?>
                <div class="container-fluid">
                    <?= $content ?>
                </div>
                    <!--
                    </div>-->               
            </div>

            <footer class="footer" style="background-color:none">
                <div class="container-fluid">
                    <!--<nav class="pull-right">
                        <ul>
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">Company</a>
                            </li>
                            <li>
                                <a href="#">Blog</a>
                            </li>
                        </ul>
                    </nav>-->
                    <p class="copyright pull-left">
                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">AyproTim</a>, made with love for a better Nation, <?= Yii::powered() ?> 
                    </p>
                </div>
            </footer>
        </div>

    </div>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
