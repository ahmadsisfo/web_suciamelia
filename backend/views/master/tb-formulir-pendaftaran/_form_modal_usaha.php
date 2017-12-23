<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\master\TbJenisZakat;
use backend\models\master\User;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $zakat backend\models\master\TbFormulirPendaftaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($zakat, 'nama_usaha')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($zakat, 'jenis_usaha')->textInput(['maxlength' => true]) ?>
    </div>    
</div>

<div class="row">
    <div class="col-md-12">
        <?= $form->field($zakat, 'rincian_anggaran_biaya')->textarea(['maxlength' => true]) ?>
    </div>    
</div>

<div class="row">
    <div class="col-md-6">
        <?php if($zakat->upload_foto_ukm){
            $url = Url::toRoute(['pict','id'=>$zakat->formulir_pendaftaran_id,'field'=>'upload_foto_ukm']);
            echo'<div class="card-avatar picture"><a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a></div>';
        } ?>
        <?= $form->field($zakat, 'upload_foto_ukm')->widget(kartik\file\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],                    
            'pluginOptions' => [
                'theme'=> 'gly',
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'showCancel' => false,
                'browseClass' => 'btn btn-info btn-sm btn-round',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  'Select Image',
                'maxFileSize' => 8000
            ],
        ]); ?>
    </div>
    <div class="col-md-6">
        <?php if($zakat->upload_foto_tempat_usaha){
            $url = Url::toRoute(['pict','id'=>$zakat->formulir_pendaftaran_id,'field'=>'upload_foto_tempat_usaha']);
            echo'<div class="card-avatar picture"><a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a></div>';
        } ?>
        <?= $form->field($zakat, 'upload_foto_tempat_usaha')->widget(kartik\file\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],                    
            'pluginOptions' => [
                 'theme'=> 'gly',
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'showCancel' => false,
                'browseClass' => 'btn btn-info btn-sm btn-round',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  'Select Image',
                'maxFileSize' => 8000
            ],
        ]); ?>
    </div>   
</div>

