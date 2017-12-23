<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPenerimaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-penerima-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'formulir_pendaftaran_id') ?>

    <?= $form->field($model, 'pernyataan_survey_id') ?>

    <?= $form->field($model, 'jumlah_zakat') ?>

    <?= $form->field($model, 'desc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
