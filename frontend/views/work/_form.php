<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;

use kartik\label\LabelInPlace;

/* @var $this yii\web\View */
/* @var $model common\models\Work */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-form">
	
    <?php $form = ActiveForm::begin(); ?>
				<div class="row">
    				<div class="col-md-6">
                        <?= $form->field($model, 'description')->widget(
                                LabelInPlace::className(),
                                [
                                    'type'  => LabelInPlace::TYPE_TEXTAREA
                                ]
                            ) ?>
                        </div>
                  </div>
                  <div class="row">
                          <div class="col-md-3">
                          <?php 
                                
                          ?>
                                           <?php echo  $form->field($model, 'time_begin')->widget(TimePicker::className(),
                                                    [
                                                        'name' => 'time_begin',
                                                        'pluginOptions' => [
                                                            'showSeconds' => true,
                                                            'showMeridian' => false,
                                                            'minuteStep' => 1,
                                                            'secondStep' => 5, 
                                                        ] 
                                                    ]
                                               )?>
            			</div>  
         				<div class="col-md-3">
                                             <?php echo   $form->field($model, 'time_end')->widget(TimePicker::className(),
                                                            [
                                                                'name' => 'time_end',
                                                                'pluginOptions' => [
                                                                    'showSeconds' => true,
                                                                    'showMeridian' => false,
                                                                    'minuteStep' => 1,
                                                                    'secondStep' => 5,
                                                                ] 
                                                            ]
                                                 )?>
                                                 
             			 </div>  
                </div>
                 <div class="row">
                          <div class="col-md-3">
                          				       <?= $form->field($model, 'money1')->widget(
                          				           LabelInPlace::className(),[
                          				                  'type'  => LabelInPlace::TYPE_TEXT
                          				           
                                                        ]) ?>
                                               
                          </div>
                          <div class="col-md-3">
                          						<?= $form->field($model, 'money2')->widget(
                          						    LabelInPlace::className(),[
                          						        'type'  => LabelInPlace::TYPE_TEXT
                          						        
                                                  ]) ?>
                          				
                          </div>
                
             </div>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
	
    <?php ActiveForm::end(); ?>

</div>
