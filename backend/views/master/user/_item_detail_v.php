<?php
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $model \backend\models\transaksi\ManifestDetail */
?>
<td>
    <span id="kompetisi_id">
        <?= Html::getAttributeValue($model, "[$key]kompetisiName", ['class'=>'form-control','data-field'=>'kompetisiName' ]) ?>
    </span>
</td>
<td>
    <span id="tingkat">
        <?= Html::getAttributeValue($model, "[$key]tingkatName", ['class'=>'form-control','data-field'=>'tingkatName' ]) ?>
    </span>
</td>
<td>
    <span id="area_id">
        <?= Html::getAttributeValue($model, "[$key]areaName", ['class'=>'form-control','data-field'=>'areaName' ]) ?>
    </span>
</td>


