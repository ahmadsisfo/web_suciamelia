<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\widgets\TabularInput;
use backend\models\master\User;

/* @var $this yii\web\View */
/* @var $model backend\models\master\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>    
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>    
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'umur')->textInput(['type'=>'number','maxlength' => true]) ?>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php  $form->field($model, 'tgl_lahir')
                    ->widget(\yii\jui\DatePicker::classname(), [
                        'language' => 'id',
                        'options' => ['class' => 'form-control col-xs-4'],
                        'dateFormat' => 'php:d/m/Y',
                    ])
                ?>                             
                <?= $form->field($model, 'tgl_lahir')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'jk')->radioList(User::enums('JK_')) ?>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'password')->passwordInput(['minlength' => true]) ?> 
                      
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'status')->checkbox(['value'=>10, 'togglebutton'=>'true',]) ?>     
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'foto')->widget(kartik\file\FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],                    
                    'pluginOptions' => [
                         'theme'=> 'gly',
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'showCancel' => false,
                        'browseClass' => 'btn btn-info btn-sm btn-round',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  'Select Photo',
                        'maxFileSize' => 8000
                    ],
                ]); ?>
            </div>
            
        </div>
        <div class="form-group">
            <?= Html::a('Assign', ['admin/assignment/view','id'=>$model->id], ['class' => 'btn btn-info','target'=>'_blank']) ?> 
        
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>    
</div>
