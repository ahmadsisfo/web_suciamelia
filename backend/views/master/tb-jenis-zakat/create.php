<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\master\TbJenisZakat */

$this->title = 'Create Tb Jenis Zakat';
$this->params['breadcrumbs'][] = ['label' => 'Tb Jenis Zakats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-jenis-zakat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
