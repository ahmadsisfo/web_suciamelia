<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        
                        <div class="card card-signup">
                            <h2 class="card-title text-center">Register</h2>
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="card-content">
                                        <div class="info info-horizontal">
                                            <div class="icon icon-rose">
                                                <i class="material-icons">timeline</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Zakat Bantuan Berobat</h4>
                                                <p class="description">
                                                    We've created the marketing campaign of the website. It was a very interesting collaboration.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-primary">
                                                <i class="material-icons">code</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Zakat Modal Usaha</h4>
                                                <p class="description">
                                                    We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="material-icons">group</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Zakat Terlilit Hutang</h4>
                                                <p class="description">
                                                    There is also a Fully Customizable CMS Admin Dashboard for this product.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="social text-center">
                                        <button class="btn btn-just-icon btn-round btn-twitter">
                                            <i class="fa fa-twitter"></i>
                                        </button>
                                        <button class="btn btn-just-icon btn-round btn-dribbble">
                                            <i class="fa fa-dribbble"></i>
                                        </button>
                                        <button class="btn btn-just-icon btn-round btn-facebook">
                                            <i class="fa fa-facebook"> </i>
                                        </button>
                                        <p class="card-title">Please fill out the following fields to register:</p>
                                        
                                    </div>
                                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                                        <div class="card-content">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <?= $form->field($model, 'email') ?>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <?= $form->field($model, 'password')->passwordInput() ?>
                                            </div>
                                            <!-- If you want to add a checkbox to this form, uncomment this code -->
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="optionsCheckboxes" checked> I agree to the
                                                    <a href="#something">terms and conditions</a>.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="footer text-center">
                                            <?= Html::submitButton('Get Started', ['class' => 'btn btn-primary btn-round', 'name' => 'signup-button']) ?>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            
    </div>

