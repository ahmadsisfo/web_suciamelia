<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPenerima */

$this->title = 'Update Tb Penerima: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Penerimas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-penerima-update">

    <?= $this->render('_form', [
        'model' => $model,
        'survey'=> $survey
    ]) ?>

</div>
