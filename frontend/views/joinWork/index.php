<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JoinWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Join Works';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="join-work-index">

    <h1><?= Html::encode("การร่วมงาน") ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Join Work', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
            'datetime_begin:datetime',
            'datetime_end:datetime',
            'request',
            'user_id',
            // 'work_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
