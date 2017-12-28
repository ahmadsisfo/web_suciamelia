<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" >
    <div class="row">
        <div class="col-md-5">
            <div class="card" style="z-index:1029">
                <div class="card-header header-raised header-primary text-center"  data-header-animation="false" data-background-color="orange">
                    <h2 class="card-title"><?= Html::encode($this->title) ?></h2>
                    <p class="card-title">Please fill out the following fields to login:</p>
                </div>
                <div class="card-content">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pull-right">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>    
</div>
