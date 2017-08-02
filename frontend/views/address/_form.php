<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Geography;

use yii\web\View;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Address */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
    function listProvinces(){
    var geo_id = $("#geo_id").val();        
    $.ajax({
        url:"'.Url::toRoute("/address/list_provinces").'",
        method: "GET",
         data: { id: geo_id }
    }).done(function(txt){
        $("#province_id").html(txt);
    });
    
    }

    function listAmphures(){
    var province_id = $("#province_id").val();        
    $.ajax({
        url:"'.Url::toRoute("/address/list_amphures").'",
        method: "GET",
         data: { id: province_id }
    }).done(function(txt){
        $("#amphur_id").html(txt);
    });
    
    }

function listDistricts(){
    var amphur_id = $("#amphur_id").val();        
    $.ajax({
        url:"'.Url::toRoute("/address/list_districts").'",
        method: "GET",
         data: { id: amphur_id }
    }).done(function(txt){
        $("#district_id").html(txt);
    });
    
    }

',
    View::POS_HEAD);
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'province_id')->
    dropDownList(ArrayHelper::map(Geography::find()->all(), 'GEO_ID', 'GEO_NAME'),
    		[
    				'style'=>'width:300px',
    				'id' => 'geo_id',
    				'prompt' => '---- เลือกภาค  ----',
    		        'onChange'=>'listProvinces()'
    		]) ?>
    <?= $form->field($model, 'province_id')->
    dropDownList([],
    		[
    				'style'=>'width:300px',
    				'id' => 'province_id',
    				'prompt' => '---- เลือกจังหวัด  ----',
    		        'onChange'=>'listAmphures()'
    		]) ?>
    		
    <?= $form->field($model, 'province_id')->
    dropDownList([],
    		[
    				'style'=>'width:300px',
    				'id' => 'amphur_id',
    				'prompt' => '---- เลือกอำเภอ  ----',
    		        'onChange'=>'listDistricts()'
    		
    		]) ?>
    		
    <?= $form->field($model, 'district_id')->
    dropDownList([],
    		[
    				'style'=>'width:300px',
    				'id' => 'district_id',
    				'prompt' => '---- เลือกตำบล   ----',
    		        'onChanged'=>'alert(this.val())'
    		
    		]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
