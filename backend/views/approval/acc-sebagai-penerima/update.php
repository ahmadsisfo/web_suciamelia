<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPernyataanSurvey */

$this->title = 'Update Acc Sebagai Penerima: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Acc Sebagai Penerima', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-pernyataan-survey-update">

    <?= $this->render('_form', [
        'model' => $model,
        'zakat' => $zakat
    ]) ?>

</div>
