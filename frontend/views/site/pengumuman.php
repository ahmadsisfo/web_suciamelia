<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Status';
$this->params['breadcrumbs'][] = $this->title;
$contact = 1234567890;
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
                <b> Status Anda - </b> <?= $status['text'] ?>
                <?php if(isset($status['field'])){ ?>
                <?= $status['field']['persen']<100?'Namun data anda belum lengkap, Mohon Lengkapi Terlebih Dahulu.':'Terimakasih Karena Sudah Melengkapi Data Anda.' ?>
                <?php } ?>
            </span>
            
        </div>
        
        <?php 
            switch($status['status']){
                case 'Penerima':
                    echo'<blockquote>
                        <p>
                            Bentuk zakat yang kami berikan kepada anda adalah <strong> '.$status['penerima']->jumlah_zakat.' '.$status['penerima']->desc.'</strong>
                        
                            . Untuk informasi lebih lanjut hubungi Customer Service kami '.$contact.'. Terima Kasih.
                        </p>
                        <small>
                            Direktur - BAZNAS
                        </small>
                    </blockquote>';
                    break;
                case 'Survey Ditolak':
                    echo'<blockquote>
                        <p>
                            Untuk informasi lebih lanjut hubungi Customer Service kami '.$contact.'. Terima Kasih.
                        </p>
                        <small>
                            Direktur - BAZNAS
                        </small>
                    </blockquote>';
                    break;
                 case 'Survey Disetujui':
                    echo'<blockquote>
                        <p>
                            Untuk informasi lebih lanjut hubungi Customer Service kami '.$contact.'. Terima Kasih.
                        </p>
                        <small>
                            Direktur - BAZNAS
                        </small>
                    </blockquote>';
                     break;
                case 'Belum Terdaftar':
                    echo' 
                    <label>0% Please Complete Your Task </label>
            
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                          <span class="sr-only">0% Complete Your Task</span>
                        </div>
                    </div>
                    
                    ';
                    break;
                default:
                    $warna = $status['field']['persen']==100?'success':'primary';
                    echo'
                    <label>'.$status['field']['persen'].'% Complete </label>
            
                    <div class="progress">
                        <div class="progress-bar progress-bar-'.$warna.' progress-bar-striped" role="progressbar" aria-valuenow="'.$status['field']['persen'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$status['field']['persen'].'%">
                          <span class="sr-only">'.$status['field']['persen'].'% Complete (success)</span>
                        </div>
                    </div>
                    ';
                    if($status['field']['persen']<100){
                        echo'<div class="alert alert-info">
                            <div class="container-fluid">
                                <div class="alert-icon"  >
                                    <i class="fa fa-info" style="color:white"></i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>

                                <b>Mohon Lengkapi Field Berikut :</b> <br/><br/> <ul>
                                ';

                        foreach($status['field']['fields'] as $item){
                            echo'<li>'.$item.'</li>';
                        }

                        echo'</ul></div>
                        </div>
                        ';
                    } else {
                        echo'<blockquote>
                            <p>
                                Tahapan Selanjutnya, tim kami akan melakukan survey, harap menunggu. Untuk informasi lebih lanjut hubungi Customer Service kami '.$contact.'. Terima Kasih.
                            </p>
                            <small>
                                Direktur - BAZNAS
                            </small>
                        </blockquote>';
                    }
                    break;
            }
        ?>
        
        
        
        
        
        
        
        
        
        
    </div>
    
   
</div>
