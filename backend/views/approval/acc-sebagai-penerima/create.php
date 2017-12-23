<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPernyataanSurvey */

$this->title = 'Create Acc Sebagai Penerima';
$this->params['breadcrumbs'][] = ['label' => 'Tb Pernyataan Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pernyataan-survey-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
