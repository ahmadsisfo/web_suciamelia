<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\master\TbJenisZakat;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPenerima */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-penerima-form card">

    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pernyataan Survey</th>
                            <th>Formulir Pendaftaran</th>
                            <th>Jenis Zakat</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>No Hp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="<?= Url::toRoute(['approval/tb-pernyataan-survey/view','id'=>$survey->id]) ?>" target="_blank">#<?= $survey->id ?></a></td>
                            <td><a href="<?= Url::toRoute(['approval/acc-sebagai-penerima/view','id'=>$survey->id]) ?>" target="_blank">#<?= $survey->nomor ?></a></td>
                            <td>ZAKAT <?= TbJenisZakat::enums('ZAKAT_')[$survey->formulirPendaftaran->jenis_zakat_id] ?></td>
                            <td><?= $survey->formulirPendaftaran->nama ?></td>
                            <td><?= $survey->formulirPendaftaran->umur ?></td>
                            <td><?= $survey->formulirPendaftaran->no_hp ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'jumlah_zakat')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Acc' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
