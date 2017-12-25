<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\master\TbJenisZakat;
use backend\models\master\TbFormulirPendaftaran;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\master\TbFormulirPendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Formulir Pendaftarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-formulir-pendaftaran-index card">

    <div class="card-header card-header-icon" data-background-color="gray">
        <i class="material-icons">list</i>
    </div>
    <div class="card-content">
        <div class="clearfix">
            <h3 class="card-title pull-left"><?= Html::encode($this->title) ?></h3>
            <div class="pull-right">
                
                <?= Html::a('<i class="material-icons">refresh</i>', ['index'], ['class' => 'btn btn-round btn-fill btn-just-icon btn-info']) ?>               
                <?= Html::a('<i class="material-icons">library_add</i>', ['create'], ['class' => 'btn btn-round btn-fill btn-just-icon btn-success']) ?>           
            </div>
        </div>
        <div class="row">
    <?= GridView::widget([
        'rowOptions' => function ($model, $key, $index, $grid) {
            if($model->status_formulir == null)
                return ['style' => 'color:black'];
            else if($model->status_formulir == TbFormulirPendaftaran::STATUS_DELETED)
                return ['style' => 'background:#F44336; color:white'];
            else if($model->status_formulir == TbFormulirPendaftaran::STATUS_PENERIMA)
                return ['style' => 'background:green; color:white'];
            else if($model->status_formulir == TbFormulirPendaftaran::STATUS_SURVEY_DISETUJUI)
                return ['style' => 'background:orange; color:white'];
            else if($model->status_formulir == TbFormulirPendaftaran::STATUS_SURVEY_DITOLAK)
                return ['style' => 'background:black; color:white'];
        },
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user_id',
            ['attribute'=>'jenis_zakat_id','value'=>function($model){return TbJenisZakat::enums('ZAKAT_')[$model->jenis_zakat_id];}],
            'nomor',
            'nama',
            // 'umur',
            // 'jk',
            // 'tgl_lahir',
            // 'alamat',
            // 'agama',
            // 'pekerjaan',
            'no_hp',
            ['attribute'=>'status_formulir','value'=>function($model){
                return $model->status_formulir!==null ? TbFormulirPendaftaran::enums('STATUS_')[$model->status_formulir]:'TERDAFTAR';
            }],
            // 'upload_surat_permohonan',
            // 'upload_ktp',
            // 'upload_kk',
            // 'upload_surat_keterangan_tidak_mampu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
    </div>
</div>