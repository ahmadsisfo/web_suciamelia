<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\master\TbJenisZakat;
use backend\models\master\TbFormulirPendaftaran;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\approval\TbPenerima */

$this->title = $model->pernyataanSurvey->formulirPendaftaran->nama;
$this->params['breadcrumbs'][] = ['label' => 'Tb Penerimas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-penerima-view card">

     <div class="card-header card-header-icon" data-background-color="green">
        <i class="material-icons">web</i>
    </div>
    <div class="card-content">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'formulir_pendaftaran_id',
            'pernyataan_survey_id',
            'jumlah_zakat',
            'desc',
        ],
    ]) ?>
    
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
            ['attribute'=>'status_formulir','value'=>function($penerima){
                return $penerima->status_formulir!==null?TbFormulirPendaftaran::enums('STATUS_')[$penerima->status_formulir]:'TERDAFTAR';
            }],
            'no_hp',
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by',
            [
                'attribute'=>'upload_ktp',
                'format'   =>'html',
                'value'    =>function($penerima){
                    $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_ktp']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $penerima->upload_ktp?$img:'';
                }
            ],
            [
                'attribute'=>'upload_kk',
                'format'   =>'html',
                'value'    =>function($penerima){
                    $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_kk']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $penerima->upload_kk?$img:'';
                }
            ],
                    
            [
                'attribute'=>'upload_surat_permohonan',
                'format'   =>'html',
                'value'    =>function($penerima){
                    $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_surat_permohonan']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $penerima->upload_surat_permohonan?$img:'';
                }
            ],
            [
                'attribute'=>'upload_surat_keterangan_tidak_mampu',
                'format'   =>'html',
                'value'    =>function($penerima){
                    $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_surat_keterangan_tidak_mampu']);
                    $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                    return $penerima->upload_surat_keterangan_tidak_mampu?$img:'';
                }
            ],
            
        ];
        $tambahan = [];
        switch ($penerima->jenis_zakat_id){
            case TbJenisZakat::ZAKAT_BANTUAN_BEROBAT:
                $tambahan = [
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_surat_keterangan_sakit',
                        'format'   =>'html',
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_surat_keterangan_sakit']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_foto_bukti_sakit',
                        'format'   =>'html',
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_foto_bukti_sakit']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_kwitansi',
                        'format'   =>'html',
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_kwitansi']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatBantuanBerobats.upload_foto_rumah',
                        'format'   =>'html',
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_foto_rumah']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $penerima->upload_ktp?$img:'';
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
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_foto_ukm']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatModalUsahas.upload_foto_tempat_usaha',
                        'format'   =>'html',
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_foto_tempat_usaha']);
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
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_surat_keterangan_hutang']);
                            $img  = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="width:100px" /></a>';
                            return $img;
                        }
                    ],
                    [
                        'attribute'=>'tbZakatTerlilitHutangs.upload_foto_rumah',
                        'format'   =>'html',
                        'value'    =>function($penerima){
                            $url  = Url::toRoute(['pict','id'=>$penerima->id,'field'=>'upload_foto_rumah']);
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
        'model' => $penerima,
        'attributes' => $attributes
    ]) ?>
    
    
    </div>
</div>
