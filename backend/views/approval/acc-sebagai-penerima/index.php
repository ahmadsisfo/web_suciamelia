<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\approval\TbPernyataanSurvey;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\approval\TbPernyataanSurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acc Sebagai Penerima';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pernyataan-survey-index card">

    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">list</i>
    </div>
    <div class="card-content">
        <div class="clearfix">
            <h3 class="card-title pull-left"><?= Html::encode($this->title) ?></h3>
            <div class="pull-right">
                
                <?= Html::a('<i class="material-icons">refresh</i>', ['index'], ['class' => 'btn btn-round btn-fill btn-just-icon btn-info']) ?>               
                
            </div>
        </div>
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    ['attribute'=>'nomor','format'=>'html','value'=>function($model){return'<a target="_blank" href="'.Url::toRoute(['master/tb-formulir-pendaftaran/view','id'=>$model->formulir_pendaftaran_id]).'">'.$model->nomor.'</a>';}],
                    [
                        'attribute'=>'formulir_pendaftaran_id',
                        'label'    =>'Nama',
                        'value'    => function($model){
                            return $model->formulirPendaftaran->nama;
                        },
                    ], 
                    ['attribute'=>'setuju', 'value'=>function($model){return TbPernyataanSurvey::enums('SURVEY_')[$model->setuju];}],
                    'desc',

                    ['class' => 'yii\grid\ActionColumn','template' => ' {view} ',],
                ],
            ]); ?>
        </div>
        
    </div>
</div>