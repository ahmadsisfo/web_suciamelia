<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\models\approval\TbPernyataanSurvey;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPernyataanSurvey */

$this->title = $model->nomor;
$this->params['breadcrumbs'][] = ['label' => 'Tb Pernyataan Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pernyataan-survey-view card">

    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('New', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= $model->setuju == TbPernyataanSurvey::SURVEY_PENERIMA ? '':Html::a('Delete', ['delete', 'id' => $model->id], [
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
            ['attribute'=>'nomor','format'=>'html','value'=>function($model){return'<a target="_blank" href="'.Url::toRoute(['master/tb-formulir-pendaftaran/view','id'=>$model->formulir_pendaftaran_id]).'">'.$model->nomor.'</a>';}],
            'formulirPendaftaran.nama',        
            ['attribute'=>'setuju', 'value'=>function($model){return TbPernyataanSurvey::enums('SURVEY_')[$model->setuju];}],
            'desc',
        ],
    ]) ?>
    </div>
</div>
