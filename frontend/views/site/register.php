<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\AuthAssignment;
use common\models\AuthItem;

$this->title = 'ลงทะเบียน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup" style="margin-top:-50px;margin-bottom:-50px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                
                <?= $form->field($model, 'fname')->textInput() ?>
                
                <?= $form->field($model, 'lname')->textInput() ?>

                <?= $form->field($model, 'email') ?>
                
                <?= $form->field($model, 'fb_id')->hiddenInput()->label(false) ?>
             
                <?php echo  $form->field($authassignment, 'item_name')->radioList([
                            '1'=>'นักรังสีเทคนิค','2'=>'โรงพยาบาล']) ->label('เลือกสิทธิ์การใข้งาน'); ?>
          		<p class="text-danger"> * สำหรับการใช้สิทธิ์ "โรงพยาบาล" จะต้องรอการอนุมัติการใช้งานก่อนถึงจะเข้าระบบได้</p>
              
                <?php // $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('สมัครสมาชิก', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
