<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\master\TbFormulirPendaftaran */

$this->title = 'Update Tb Formulir Pendaftaran: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Formulir Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->tbFormulirPendaftaran->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-formulir-pendaftaran-update">

    <?= $this->render('_form', [
        'model' => $model,
        'zakat' => $zakat
    ]) ?>

</div>
