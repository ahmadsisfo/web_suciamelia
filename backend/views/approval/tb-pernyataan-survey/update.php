<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPernyataanSurvey */

$this->title = 'Update Tb Pernyataan Survey: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Pernyataan Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-pernyataan-survey-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
