<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\master\TbFormulirPendaftaran;
use frontend\models\master\TbJenisZakat;
use frontend\models\master\UserBiasa;

$this->title = 'Cetak Bukti Pendaftaran';
$this->params['breadcrumbs'][] = $this->title;
$contact = 1234567890;
?>
<style>@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}</style>
<div class="site-about card">
    <div class="card-header card-header-icon no-print" data-background-color="rose">
        <i class="material-icons">assignment</i>
    </div>
    <div class="card-content">
        <h4 class="card-title"><?= $this->title ?></h4>
        <?php if(isset($status['field']['persen']) && $status['field']['persen'] == 100){ ?>
        
        <div class="row no-print">
            <div class="col-md-12">
                <a href="#" onclick="print();" class=" card-title btn btn-info pull-right"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                
            
                <div class="table-responsive">
                    <table class="table">
                       
                        <tbody>
                            <tr>
                                <td>Nomor Pendaftaran</td>
                                <td class="text-primary">#<?= $model->nomor ?></td>
                                <td rowspan="3" class="">
                                    <div id="qrcode1" class="text-center" style="width:100px;"><?= $model->nomor ?></div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>Tipe Zakat</td>
                                <td class="text-primary" ><?= TbJenisZakat::enums('ZAKAT_')[$model->jenis_zakat_id] ?></td>
                                
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td class="text-primary"><?= $model->nama ?></td>
                                
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td class="text-primary" colspan="2"><?= UserBiasa::enums('JK_')[$model->jk] ?></td>
                                
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td class="text-primary" colspan="2"><?= $model->agama ?></td>
                                
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td class="text-primary" colspan="2"><?= $model->pekerjaan ?></td>
                                
                            </tr>
                            <tr>
                                <td>No Hp</td>
                                <td class="text-primary" colspan="2"><?= $model->no_hp ?></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
        </div>
        
        
                            

        <blockquote>
            <p style="font-size:12px">
                Bukti Pendaftaran ini adalah bukti yang sah. Tahapan Selanjutnya, tim kami akan melakukan survey, harap menunggu. Untuk informasi lebih lanjut hubungi Customer Service kami <?= $contact ?> Terima Kasih.
            </p>
            <small>
                Direktur - BAZNAS
            </small>
        </blockquote>
        
        <?php
        $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/lrsjng.jquery-qrcode/0.14.0/jquery-qrcode.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
        $js = '$("#qrcode1").qrcode({render: \'image\',mode:0, label: \'PRO Ekspedisi\',size: 70,text:\'' . $model->nomor . '\'});';
        $this->registerJs($js);

        ?>
        
        <?php }else{  ?>
            <div class="alert alert-warning">
                 <button type="button" aria-hidden="true" class="close">×</button>
                 <span>
                     <b> Status Anda - </b> <?= $status['text'] ?>
                     
                 </span>

             </div>
             
     
        <?php $this->registerJs('setTimeout(function(){ window.location.href = "'.yii\helpers\Url::toRoute(['formulir']).'"; }, 2000);'); } ?>
        
        
        
        
        
        
        
    </div>
    
   
</div>
