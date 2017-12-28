<?php

namespace frontend\assets;

use yii\base\Exception;
use yii\web\AssetBundle as BaseMaterialAsset;

/**
 * Material AssetBundle
 * @since 0.1
 */
class MaterialAssetLanding extends BaseMaterialAsset
{
    public $sourcePath = '@vendor/ramosisw/yii2-landing/assets';


    public $css = [
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700',
        'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'css/bootstrap.min.css',
        'css/material-kit.css',
        'css/demo.css',
    ];

    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/material.min.js',
        'js/nouislider.min.js',
        'js/bootstrap-datepicker.js',
        'js/material-kit.js',
        'js/jquery.sharrre.js',        
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
