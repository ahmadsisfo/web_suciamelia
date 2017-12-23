<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\master\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index card">
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
        'rowOptions' => function ($model, $key, $index, $grid) {
            if($model->status == Yii::STATUS_DELETED)
                return ['style' => 'background:#F44336; color:white'];
        },
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'userProfile.fullname',
            'nama',
            //'email',
            //'userProfile.phone',
            'no_hp',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            // 'email:email',
            [
                'attribute'=>'status',
                'value' => function($model){
                    return \backend\models\master\User::enums('STATUS_')[$model->status];
                }
            ],
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => ''],
                'template' => ' {view}  {update} {delete} {assign} ',
                'buttons' => [
                    'assign' => function ($url,$model) {
                        if($model->status== \common\models\User::STATUS_ACTIVE){
                            return Html::a('<span class="glyphicon glyphicon-random btn btn-primary btn-xs"></span>',
                            Yii::$app->getUrlManager()->createUrl(['admin/assignment/view','id'=>$model->id]));
                        }
                    },                        
                    'view' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open btn btn-info btn-xs"></span>',
                            $url);
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil btn btn-success btn-xs"></span>',
                            $url);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-trash btn btn-danger btn-xs"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],

            ],
        ],
    ]); ?>
        </div>
    </div>
</div>
