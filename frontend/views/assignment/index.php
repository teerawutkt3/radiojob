<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use wattanapong\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_name',
            [
                'attribute' => 'nameSearch',
                'value' => 'user.username'
            ],
         
          /*   [
                'attribute' => 'nameSearch',
                'value' => 'user.username',
            ], */
            [
                'attribute' =>'created_at',
                'format' => 'html',
                'value' => function($model, $key, $index, $widget) {
                return Yii::$app->formatter->asDatetime($model->created_at,"medium");
                },
                'filter' => DateTimePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        //'value' => $searchModel->created_at,
                        'value' => Yii::$app->formatter->asDatetime($searchModel->created_at,"medium"),
                        'language' => 'th',
                        'dateFormat' => 'dd M yyyy',
                        'timeFormat' => 'h:m',
                        'options' => [
                            'autoclose' => true
                        ],
                    ]
                    )
                    ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
