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
        
        <label>40% Complete </label>
            
        <div class="progress">
            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
              <span class="sr-only">40% Complete (success)</span>
            </div>
        </div>
        
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
