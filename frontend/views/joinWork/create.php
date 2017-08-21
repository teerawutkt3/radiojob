<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JoinWork */

$this->title = 'Create Join Work';
$this->params['breadcrumbs'][] = ['label' => 'Join Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="join-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
