<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JoinWorkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="join-work-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'datetime_begin') ?>

    <?= $form->field($model, 'datetime_end') ?>

    <?= $form->field($model, 'request') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'work_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
