<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\master\TbJenisZakatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Jenis Zakats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-jenis-zakat-index card">

    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">list</i>
    </div>
    <div class="card-content">
        <div class="clearfix">
            <h3 class="card-title pull-left"><?= Html::encode($this->title) ?></h3>
            <div class="pull-right">
                
                <?= Html::a('<i class="material-icons">refresh</i>', ['index'], ['class' => 'btn btn-round btn-fill btn-just-icon btn-info']) ?>               
                <?= Html::a('<i class="material-icons">library_add</i>', ['create'], ['class' => 'btn btn-round btn-fill btn-just-icon btn-success']) ?>           
            </div>
        </div>
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'nama',
                    'desc',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>