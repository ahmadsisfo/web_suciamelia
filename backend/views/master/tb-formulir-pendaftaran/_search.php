<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\master\TbFormulirPendaftaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-formulir-pendaftaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'jenis_zakat_id') ?>

    <?= $form->field($model, 'nomor') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'umur') ?>

    <?php // echo $form->field($model, 'jk') ?>

    <?php // echo $form->field($model, 'tgl_lahir') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'upload_surat_permohonan') ?>

    <?php // echo $form->field($model, 'upload_ktp') ?>

    <?php // echo $form->field($model, 'upload_kk') ?>

    <?php // echo $form->field($model, 'upload_surat_keterangan_tidak_mampu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
