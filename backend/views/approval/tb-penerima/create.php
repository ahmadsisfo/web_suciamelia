<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPenerima */

$this->title = 'Create Tb Penerima';
$this->params['breadcrumbs'][] = ['label' => 'Tb Penerimas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-penerima-create">

    <?= $this->render('_form', [
        'model' => $model,
        'survey'=> $survey
    ]) ?>

</div>
