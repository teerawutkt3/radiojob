<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Geography;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('
    function listProvinces(){
    var geo_id = $("#geo_id").val();
    $.ajax({
        url:"'.Url::toRoute("address/list_provinces").'",
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

<div class="user-form">
        	<div class="row">
        				<div class="col-md-4">
                                    <?php $form = ActiveForm::begin(); ?>
                                
                                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>   
            </div>     
            <div class="row">
        				<div class="col-md-4">
                         			   <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
                         </div>
               			<div class="col-md-4">
                          			  <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
                            </div>
            </div>   
              <div class="row">    
              			<div class="col-md-5">     
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
             </div>
              <div class="row">    
              			<div class="col-md-6">     
                        <?= $form->field($address, 'value')->textarea(['rows' => 6]) ?>
                          </div>
             </div>
              <div class="row">    
              			<div class="col-md-3">     
                         <?= $form->field($address, 'geo_id')->
                            dropDownList(ArrayHelper::map(Geography::find()->all(), 'GEO_ID', 'GEO_NAME'),
                            		[
                            				
                            				'id' => 'geo_id',
                            				'prompt' => 'ภาค',
                            		        'onChange'=>'listProvinces()'
                            		]) ?>
                          </div>
        				    <div class="col-md-3">     
                            <?= $form->field($address, 'province_id')->
                            dropDownList([],
                            		[
                            			
                            				'id' => 'province_id',
                            			//	'prompt' => 'เลือกจังหวัด',
                            		        'onChange'=>'listAmphures()'
                            		]) ?>
                            	 </div>	
                            	  <div class="col-md-3">     
                            <?= $form->field($address, 'province_id')->
                            dropDownList([],
                            		[
                            				
                            				'id' => 'amphur_id',
                            			//	'prompt' => '---- เลือกอำเภอ  ----',
                            		        'onChange'=>'listDistricts()'
                            		
                            		]) ?>
                            		</div>
                            		 <div class="col-md-3">     
                            <?= $form->field($address, 'district_id')->
                            dropDownList([],
                            		[
                            				
                            				'id' => 'district_id',
                            		//		'prompt' => '---- เลือกตำบล   ----',
                            		        'onChanged'=>'alert(this.val())'
                            		
                            		]) ?>
                            		</div>
		</div>    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	
    <?php ActiveForm::end(); ?>

</div>
