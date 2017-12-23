<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\master\TbJenisZakat */

$this->title = 'Update Tb Jenis Zakat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Jenis Zakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-jenis-zakat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
