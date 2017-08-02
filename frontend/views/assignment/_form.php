<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\AuthItem;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
function getAuthAssignment(id){
    $("#authassignment-item_name").val($("#user"+id).val());
}',View::POS_END);

?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList(
                        ArrayHelper::map(AuthItem::find()->all(), 'name', 'name'),
                         [
                             'prompt' => '---- เลือกสิทธิ  ----',
                         ]
        ) ?>

    
    <?= $form->field($model, 'user_id')->dropDownList(
     //   ArrayHelper::map(User::find()->all(), 'id', 'username'),
        ArrayHelper::map(User::find()->where(['status'=>20])->all(), 'id', 'username'),
                        [
                            'prompt' => '---- เลือกผู้ใช้  ----',
                            'onChange' => 'getAuthAssignment($(this).val())'
                        ]
        ) ?>
        
        <?php 
         foreach ($user as $u){
            $auth = \common\models\AuthAssignment::find()->where(['user_id'=>$u->id])->one();
            if ($auth) echo "<input type='hidden' id='user".$u->id."'  value='".$auth->item_name."'>";
        }
         
        ?>
        

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
