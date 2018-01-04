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
<body class="" style="background-image: url('assets/img/bg2.jpeg');">
    <?php $this->beginBody() ;
    $this->registerJs('
        $("input[togglebutton=\"true\"]").parent().parent().addClass("togglebutton");
        $("input[type=\"radio\"]").click(function(){
            $(this).parent().parent().parent().find("input[type=\"radio\"]").attr("checked", false);
            $(this).attr("checked", true);
        });
        ', View::POS_END);
    ?>
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=" ./ "><?= Yii::$app->name ?></a>
            </div>
            <div class="navbar-collapse" style="z-index:9999999999">
                <ul class="nav navbar-nav navbar-right " >
                    
                    <li>
                        <a href="<?= Url::toRoute(['site/signup']) ?>">
                            <i class="material-icons">person_add</i> Register
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::toRoute(['site/login']) ?>">
                            <i class="material-icons">fingerprint</i> Login
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page register-page" filter-color="black" data-image="../../assets/img/register.jpeg">
            <div class="container">
                <?= $content ?>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>                            
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">AyproTim</a>, made with love for a better Nation, <?= Yii::powered() ?> 
                    </p>
                </div>
            </footer>
        </div>
    </div>
<!--<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs1.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582NzYpoUazw5mb6KZoU0QBxG6IFp667%2flSh874QMjKer6xwfctcPkI7g0Eg0OiFh4JStf4w1GscYUSbFoLO2iMZvdF7fAOleGjNu0if5acS96tIbn4HOMb%2fHHvMzxkoB3jCTWgKBXZtURobHKlcPFFW9xf%2ft2nrmUERYVYRV20kBJMcTRjhO1YueXbzABydy7Qrq8N5mUvUfBfQ%2fGOrb2nYDwsYXnOLRQ6gcJ57tbS1I9MnRmcKNZzjBMrlzMYQDLeMcnUG%2f1Tth81M4UFs11qz0VdT8ge3mh9LXLeTlQB0ssbpDzNnUNCfddCFGX8s9I2iE9MI6pmPsN7aO0xqjVxcYDbmZeFki731jdiPcAX7DUNAd6IjpOpn6gvDWbnQo491iiAxfR7Soezj7WENiM4r%2bnfh0hh3d5YEuq4LYTjPoSEOWVtfYUYfJBn9Z59UPPcyXK3lWpZSsIBd7KLspscti33u3HKUYg9AGdGWHiQp6gJNbXc04S5vXhW82kNLQ%2bvK1uhwbpGfzMd9w4pBGoJURzlI%2bO7ii%2fTbkCSU58W9xxP8IFs%2bIMLl%2bxgCIhC8KrfBcWIveF%2fQQO%2b3%2biHOos9yrSakda0%2bid%2fiLNpS%2bSeTHNG5DsVCMegXvuUMSFTAyWWuVfgNe9qD%2f16tWC6WDpTEfbk%2bok4skgGzP4Rv0sRMqz1c4XXSmiO1za2FgOAULVhwIZWNz2RGumgriKzMZJt69YEMTbik6fGTDFjgUbwQANeikWDy%2bg4sY47UAqkSx2JYIyfA3wO12ahSYElD3cqWtDXsS1Zzsjtar2SVIyHcTqFaVqzFvjOhFK0mZ%2fVmSPkx9qnEF91h7IDxDPoZ3X5N6bD0KfEjclGtY8IGz%2bm%2b3JgYTQUJeCDHBoQsjZ0UMFLwwrW7mm9q0jjHyD94jEpdILflF2qMD5vFMPrzerfUNye6wUPdNLkIZ8Xs1ppu86MN1F%2b0qNi40AKPb6OT92UsKNO6Gprp0cM7tMWvar7a3lgG%2bHiNoVkeIiORPjKhEPlZsxSrPmGwvdRt8x8s1I5QONN%2fbGe690dnetgkRyMd2z37U%2fSjiUVZZGq99y2cVQ%2bg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title">Background Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <div class="togglebutton switch-sidebar-image">
                        <label>
                            <input type="checkbox" checked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <p>Filters</p>
                    <div class="badge-colors pull-right">
                        <span class="badge filter active" data-color="black"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-rose" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Background Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-1.jpg" data-src="../../assets/img/login.jpeg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-2.jpg" data-src="../../assets/img/lock.jpeg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-3.jpg" data-src="../../assets/img/header-doc.jpeg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-4.jpg" data-src="../../assets/img/bg-pricing.jpeg" alt="" />
                </a>
            </li>
            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-primary btn-block btn-fill">Buy Now!</a>
                </div>
                <div class="">
                    <a href="http://www.creative-tim.com/product/material-dashboard" target="_blank" class="btn btn-info btn-block">Get Free Demo</a>
                </div>
            </li>
            <li class="header-title">Thank you for 95 shares!</li>
            <li class="button-container">
                <button id="twitter" class="btn btn-social btn-twitter btn-round"><i class="fa fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-social btn-facebook btn-round"><i class="fa fa-facebook-square"></i> &middot; 50</button>
            </li>
        </ul>
    </div>
</div>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
