<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\master\User;
use yii\helpers\Url;
use mdm\widgets\TabularInput;
/* @var $this yii\web\View */
/* @var $model backend\models\master\user */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-view card wizard-card">

    <div class="card-header card-header-icon" data-background-color="blue" >
        <div class="card-avatar picture" >
            <a href="<?= Url::toRoute(['master/user/pict','id'=>$model->id]) ?>" target="_blank">
                <img classs="img" src="<?= Url::toRoute(['master/user/pict','id'=>$model->id]) ?>">
            </a>           
        </div>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('New', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Assign', ['admin/assignment/view','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nama',
            'auth_key',
            //'password_hash',
            'password_reset_token',
            'email:email',
            'no_hp',
            'tgl_lahir:datetime',
            [
                'attribute'=>'status',
                'value' => function($model){
                    return User::enums('STATUS_')[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            
            
        ],
    ]) ?>
        
</div>
