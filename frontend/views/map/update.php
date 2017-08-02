<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Map */

$this->title = 'Update Map: ' . $model->MAP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MAP_ID, 'url' => ['view', 'id' => $model->MAP_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="map-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
