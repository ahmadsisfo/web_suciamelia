<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\master\TbFormulirPendaftaran;
use backend\models\master\TbJenisZakat;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\master\TbFormulirPendaftaran */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Acc Sebagai Penerima', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-formulir-pendaftaran-view card">

    <div class="card-header card-header-icon" data-background-color="gray">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Approve', ['approval/tb-penerima/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?php
        $attributes = [
            'id',
            'user_id',
            'jenis_zakat_id',
            'nomor',
            'nama',
            'umur',
            'jk',
            'tgl_lahir',
            'alamat',
            'agama',
            'pekerjaan',
            ['attribute'=>'status_formulir','value'=>function($model){
                return $model->status_formulir!==null?TbFormulirPendaftaran::enums('STATUS_')[$model->status_formulir]:'TERDAFTAR';
            }],
            'no_hp',
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by',
            [
                'attribute'=>'upload_ktp',
                'format'   =>'html',
                'value'    =>function($model){
                    $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_ktp']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $model->upload_ktp?$img:'';
                }
            ],
            [
                'attribute'=>'upload_kk',
                'format'   =>'html',
                'value'    =>function($model){
                    $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_kk']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $model->upload_kk?$img:'';
                }
            ],
                    
            [
                'attribute'=>'upload_surat_permohonan',
                'format'   =>'html',
                'value'    =>function($model){
                    $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_surat_permohonan']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $model->upload_surat_permohonan?$img:'';
                }
            ],
            [
                'attribute'=>'upload_surat_keterangan_tidak_mampu',
                'format'   =>'html',
                'value'    =>function($model){
                    $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_surat_keterangan_tidak_mampu']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $model->upload_surat_keterangan_tidak_mampu?$img:'';
                }
            ],
            
        ];
        $tambahan = [];
        switch ($model->jenis_zakat_id){
            case TbJenisZakat::ZAKAT_BANTUAN_BEROBAT:
                $tambahan = [
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_surat_keterangan_sakit',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_surat_keterangan_sakit']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_foto_bukti_sakit',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_foto_bukti_sakit']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_kwitansi',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_kwitansi']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_foto_rumah',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_foto_rumah']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],                                    
                ];
                break;
            case TbJenisZakat::ZAKAT_MODAL_USAHA:
                $tambahan = [
                    'tbZakatModalUsahas.nama_usaha',
                    'tbZakatModalUsahas.jenis_usaha',
                    'tbZakatModalUsahas.rincian_anggaran_biaya',
                    [
                        'attribute'=>'tbZakatModalUsahas.upload_foto_ukm',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_foto_ukm']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatModalUsahas.upload_foto_tempat_usaha',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_foto_tempat_usaha']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],        
                ];
                break;
            case TbJenisZakat::ZAKAT_TERLILIT_HUTANG:
                $tambahan = [
                    [
                        'attribute'=>'tbZakatTerlilitHutangs.upload_surat_keterangan_hutang',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_surat_keterangan_hutang']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatTerlilitHutangs.upload_foto_rumah',
                        'format'   =>'html',
                        'value'    =>function($model){
                            $url  = Url::toRoute(['pict','id'=>$model->id,'field'=>'upload_foto_rumah']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ], 
                ];
                break;
            default:
                break;
        }
        $attributes = array_merge($attributes, $tambahan);
    ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes
    ]) ?>
    
    
    </div>
</div>
