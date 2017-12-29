<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\master\TbJenisZakat;
use backend\models\master\User;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\master\TbFormulirPendaftaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-formulir-pendaftaran-form card  wizard-card">
    <div class="card-header card-header-icon" data-background-color="gray">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
            
            <?php $form = ActiveForm::begin(); ?>
        
            <div class="row">
                <div class="col-md-12">
                    <h4>Account</h4>
                    <hr class="btn btn-round btn-block btn-success" style="padding:5px; width:99%">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'username')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'email')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'password')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <br/>
                    <?= $form->field($model, 'status')->checkbox(['value'=>10, 'togglebutton'=>'true',]) ?>     
                </div>
                
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <h4>Formulir</h4>
                    <hr class="btn btn-round btn-block btn-success" style="padding:5px; width:99%">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'jenis_zakat_id')->dropDownList(ArrayHelper::map(TbJenisZakat::find()->all(), 'id', 'nama'), ['prompt'=>'- Pilih Jenis Zakat -']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'nomor')->textInput(['maxlength' => true,'disabled'=>$model->isNewRecord?false:true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-md-3">
                    <?php  $form->field($model, 'tgl_lahir')
                        ->widget(\yii\jui\DatePicker::classname(), [
                            'language' => 'id',
                            'options' => ['class' => 'form-control col-xs-4'],
                            'dateFormat' => 'php:d/m/Y',
                        ])
                    ?>                             
                    <?= $form->field($model, 'tgl_lahir')->textInput() ?>
                </div>
                <div class="col-md-1">
                    <?= $form->field($model, 'umur')->textInput(['type'=>'number']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'jk')->radioList(User::enums('JK_'))->label('Jenis Kelamin') ?>    
                </div> 
                
            </div> 
     
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'pekerjaan')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
                </div>                
            </div>                     
    
            <div class="row">
                <div class="col-md-12">
                    <h4>Berkas Utama</h4>
                    <hr class="btn btn-round btn-block btn-success" style="padding:5px; width:99%">
                </div>
            </div>
    
            
            <div class="row">
                <div class="col-md-6">
                    <?php if($model->upload_ktp){
                        $url = Url::toRoute(['pict','id'=>$model->tbFormulirPendaftaran->id,'field'=>'upload_ktp']);
                        echo'<div class="card-avatar picture"><a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a></div>';
                    } ?>
                    <?= $form->field($model, 'upload_ktp')->widget(kartik\file\FileInput::classname(), [
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
                    <?php if($model->upload_kk){
                        $url = Url::toRoute(['pict','id'=>$model->tbFormulirPendaftaran->id,'field'=>'upload_kk']);
                        echo'<div class="card-avatar picture"><a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a></div>';
                    } ?>
                    <?= $form->field($model, 'upload_kk')->widget(kartik\file\FileInput::classname(), [
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
    
            
            <div class="row">    
                <div class="col-md-6">
                     <?php if($model->upload_surat_permohonan){
                        $url = Url::toRoute(['pict','id'=>$model->tbFormulirPendaftaran->id,'field'=>'upload_surat_permohonan']);
                        echo'<div class="card-avatar picture"><a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a></div>';
                    } ?>
                    <?= $form->field($model, 'upload_surat_permohonan')->widget(kartik\file\FileInput::classname(), [
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
                     <?php if($model->upload_surat_keterangan_tidak_mampu){
                        $url = Url::toRoute(['pict','id'=>$model->tbFormulirPendaftaran->id,'field'=>'upload_surat_keterangan_tidak_mampu']);
                        echo'<div class="card-avatar picture"><a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a></div>';
                    } ?>
                    <?= $form->field($model, 'upload_surat_keterangan_tidak_mampu')->widget(kartik\file\FileInput::classname(), [
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

            <?php if($model->jenis_zakat_id){ ?>
            <div class="row">
                <div class="col-md-12">
                    <h4>Tambahan Syarat Zakat <?= TbJenisZakat::enums('ZAKAT_')[$model->jenis_zakat_id] ?></h4>
                    <hr class="btn btn-round btn-block btn-success" style="padding:5px; width:99%">
                </div>
            </div>
            <?php 
                switch($model->jenis_zakat_id){
                    case TbJenisZakat::ZAKAT_BANTUAN_BEROBAT:
                        echo $this->render('_form_bantuan_berobat', ['form'=>$form,'zakat' => $zakat]);
                        break;
                    case TbJenisZakat::ZAKAT_MODAL_USAHA:
                        echo $this->render('_form_modal_usaha', ['form'=>$form,'zakat' => $zakat]);
                        break;
                    case TbJenisZakat::ZAKAT_TERLILIT_HUTANG:
                        echo $this->render('_form_terlilit_hutang', ['form'=>$form,'zakat' => $zakat]);
                        break;
                }
            } ?>
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= $model->jenis_zakat_id ? '<button type="submit" class="btn btn-success" name="submit" value="true" >Submit</button>':'' ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
