<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Url;
use backend\models\master\TbJenisZakat;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPernyataanSurvey */
/* @var $form yii\widgets\ActiveForm */
?>

 <div class="row">
    <div class="col-md-8">

        <div class="tb-pernyataan-survey-form card">

            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">web</i>
            </div>
            <div class="card-content">
                <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
            <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'nomor')->widget(\yii\jui\AutoComplete::classname(), [
                            'options' => ['class' => 'form-control'],
                            'clientOptions' => [
                                'source'=>new JsExpression("function(request, response) {
                                    $.getJSON('".yii\helpers\Url::toRoute(['approval/tb-pernyataan-survey/get-formulir-pendaftaran'])."', {term: request.term}, response);
                                }"),
                                'autoFill' => true,
                                'minLength' => 1,
                                'max' => 10,
                                'select' => new JsExpression("function( event, ui ) {
                                    $('#tbpernyataansurvey-formulir_pendaftaran_id').val(ui.item.id);
                                    $('.card-profile .nomor').html('#'+ui.item.value);
                                    $('.card-profile .nama').html(ui.item.nama);
                                    $('.card-profile .linkktp').attr('href',ui.item.ktp);
                                    $('.card-profile .linkktp').find('img').attr('src',ui.item.ktp);
                                    $('.card-profile .linkdetail').attr('href',ui.item.detail);
                                    var info = 'tgl lahir '+ ui.item.tgl_lahir +'</br>'+ 'Jenis Zakat : '+ui.item.jenis_zakat;
                                    $('.card-profile .info').html(info);
                                    $('.card-profile').slideDown('slow');
                                    
                                }"),
                                'change' => new JsExpression("function( event, ui ) {
                                    if (ui.item == null) {
                                        $(this).val('');
                                    }
                                }"),

                            ],

                        ]) ?>

                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-5">
                        <?= $form->field($model, 'formulir_pendaftaran_id')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'setuju')->checkbox(['value'=>1, 'togglebutton'=>'true',])->label('Setuju ? ') ?>     
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>    
            
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
            </div>
        </div>    
    </div>
    <div class="col-md-4">
        <div class="card card-profile wizard-card" style="display:none">
            <div class="card-avatar picture">
                <a href="" target="_blank" class="linkktp">
                    <img class="img" src="">
                </a>
            </div>
            <div class="content">
                <h6 class="nomor category text-gray"></h6>
                <h4 class="nama card-title"></h4>
                <p class="card-content info">
                    
                </p>
                <a href="" class="btn btn-primary btn-round linkdetail" target="_blank">Detail</a>
            </div>
        </div>
    </div>
</div>    
<?php 
if(!$model->isNewRecord){
    if($model->formulir_pendaftaran_id != null ){        
    $this->registerJs('
        $(document).ready(function () {        
        var customer_id = "'.$model->formulir_pendaftaran_id.'";
        if(customer_id != ""){
            $(".card-profile .nomor").html("#'.$model->nomor.'");
            $(".card-profile .nama").html("'.$model->formulirPendaftaran->nama.'");
            var linkktp    = "'.Url::toRoute(['master/tb-formulir-pendaftaran/pict','id'=>$model->id,'field'=>'upload_ktp']).'";
            $(".card-profile .linkktp").attr("href",linkktp);
            $(".card-profile .linkktp").find("img").attr("src",linkktp);
            var linkdetail = "'.Url::toRoute(['master/tb-formulir-pendaftaran/view','id'=>$model->id]).'";
            $(".card-profile .linkdetail").attr("href",linkdetail);
            var info = "tgl lahir '.$model->formulirPendaftaran->tgl_lahir.'</br>Jenis Zakat : '.TbJenisZakat::enums('ZAKAT_')[$model->formulirPendaftaran->jenis_zakat_id].'";
            $(".card-profile .info").html(info);
            $(".card-profile").slideDown("slow");
            
            
        } });
        ', View::POS_END);
    }
}
?>
