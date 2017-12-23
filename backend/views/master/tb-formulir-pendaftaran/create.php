<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\master\TbFormulirPendaftaran */

$this->title = 'Create Tb Formulir Pendaftaran';
$this->params['breadcrumbs'][] = ['label' => 'Tb Formulir Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-formulir-pendaftaran-create">

    <?= $this->render('_form', [
        'model' => $model,        
    ]) ?>

</div>
