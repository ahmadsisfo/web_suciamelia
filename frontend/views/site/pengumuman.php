<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Status';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about card">
    <div class="card-header card-header-icon" data-background-color="green">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        
        
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <p>This is the About page. You may modify the following file to customize its content:</p>

        
        <div class="alert alert-info">
            <div class="container-fluid">
                <div class="alert-icon"  >
                    <i class="fa fa-info" style="color:white"></i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>

                <b>Info alert:</b> You've got some friends nearby, stop looking at your phone and find them...
            </div>
        </div>
    </div>
    
   
</div>
