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
        
        <div class="alert alert-<?= $status['alert'] ?>">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span>
                <b> Status Anda - </b> <?= $status['text'] ?></span>
        </div>
        
        <?php 
            switch($status['status']){
                case 'Penerima':
                    echo'<blockquote>
                        <p>
                            Bentuk zakat yang kami berikan kepada anda adalah <strong> '.$status['penerima']->jumlah_zakat.' '.$status['penerima']->desc.'</strong>
                        
                            . Untuk informasi lebih lanjut hubungi Customer Service kami 08123456789. Terima Kasih.
                        </p>
                        <small>
                            Direktur - BAZNAS
                        </small>
                    </blockquote>';
                    break;
                case 'Survey Ditolak':
                    echo'<blockquote>
                        <p>
                            Untuk informasi lebih lanjut hubungi Customer Service kami 08123456789. Terima Kasih.
                        </p>
                        <small>
                            Direktur - BAZNAS
                        </small>
                    </blockquote>';
                    break;
                 case 'Survey Disetujui':
                    echo'<blockquote>
                        <p>
                            Untuk informasi lebih lanjut hubungi Customer Service kami 08123456789. Terima Kasih.
                        </p>
                        <small>
                            Direktur - BAZNAS
                        </small>
                    </blockquote>';
                     break;
                default:
                    echo'
                    <p>This is the About page. You may modify the following file to customize its content:</p>

                    <label>40% Complete </label>
            
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                          <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <div class="container-fluid">
                            <div class="alert-icon"  >
                                <i class="fa fa-info" style="color:white"></i>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                            </button>

                            <b>Info alert:</b> You`ve got some friends nearby, stop looking at your phone and find them...
                        </div>
                    </div>
                    ';
                    break;
            }
        ?>
        
        
        
        
        
        
        
        
        
        
    </div>
    
   
</div>
