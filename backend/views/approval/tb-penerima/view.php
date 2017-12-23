<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPenerima */

$this->title = $model->pernyataanSurvey->formulirPendaftaran->nama;
$this->params['breadcrumbs'][] = ['label' => 'Tb Penerimas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-penerima-view card">

     <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'formulir_pendaftaran_id',
            'pernyataan_survey_id',
            'jumlah_zakat',
            'desc',
        ],
    ]) ?>
    </div>
</div>
