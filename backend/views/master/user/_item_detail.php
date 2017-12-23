<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use backend\models\master\Kompetisi;
use backend\models\master\UserArea;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $model \backend\models\transaksi\ManifestDetail */
?>
<td>
    <span id="kompetisi_id">
        <?= Html::activeDropDownList($model, "[$key]kompetisi_id", ArrayHelper::map(Kompetisi::findAll(['status'=>  Kompetisi::STATUS_ACTIVE]), 'id', 'nama'), ['class'=>'form-control','data-field'=>'kompetisi_id' ]) ?>        
    </span>
</td>
<td>    
    <span id="tingkat">
        <?= Html::activeDropDownList($model, "[$key]tingkat", UserArea::enums('TINGKAT_'), ['class'=>'form-control','data-field'=>'tingkat' ]) ?>        
    </span>   
</td>
<td>    
    <h6 id="area_id">        
        <?= AutoComplete::widget([
            'model' => $model,
            'attribute' => "[$key]areaName",
            'options' => ['class' => 'form-control','data-field'=>'areaName'],
            'clientOptions' => [
                'source'=>new JsExpression("function(request, response) {
                    $.getJSON('".Url::toRoute(['master/user/get-area'])."', {term: request.term,tingkat:$('select[name=\"UserArea[$key][tingkat]\"] option:selected').val()}, response);
                }"),
                'autoFill' => true,
                'minLength' => 1,
                'max' => 10,
                'select' => new JsExpression("function( event, ui ) {
                    $('#userarea-".$key."-area_id').val(ui.item.id);
                }"),
                'change' => new JsExpression("function( event, ui ) {
                    if (ui.item == null) {
                        $(this).val('');
                    }
                }"),

            ],
        ]); ?>
        <?= Html::activeHiddenInput($model, "[$key]area_id", ['data-field'=>'area_id' ]) ?>    
    </h6>   
</td>
<td ><a data-action="delete"><span class="glyphicon glyphicon-trash btn btn-danger btn-xs"></span></a></td>


