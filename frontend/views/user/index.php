<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use wattanapong\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';

?>

<div class="user-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-primary">
                   	<div class="panel-heading"><h1><?= Html::encode("ผู้ใช้งาน") ?></h1></div>
                   <div class="panel-body ">
                               	

            <?php Pjax::begin([
            		'enablePushState'=>false
            ]); ?> 
                                  <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                
                                            'id',
                                            'username',
                                            'fname',
                                            'lname',
                                             'email:email',
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
                                                                'autoclose' => true,
                                                                'class' => 'form-control',
                                                                'placeholder'=>'วันที่'
                                                            ],
                                                        ]
                                                        )
                                            ], 
                                            
                                            
                                            
                                            
                                            [
                                                'attribute' =>'created_at',
                                                'format' => 'html',
                                                'value' => function($model, $key, $index, $widget) {
                                                return Yii::$app->formatter->asDatetime($model->created_at,"medium");
                                                },
                                                'filter' => DateTimePicker::widget(
                                                    [
                                                        'model' => $searchModel,
                                                        'attribute' => 'updated_at',
                                                        //'value' => $searchModel->created_at,
                                                        'value' => Yii::$app->formatter->asDatetime($searchModel->updated_at,"medium"),
                                                        'language' => 'th',
                                                        'dateFormat' => 'dd M yyyy',
                                                        'timeFormat' => 'h:m',
                                                        'options' => [
                                                            'autoclose' => true,
                                                            'class' => 'form-control',
                                                            'placeholder'=>'วันที่'
                                                        ],
                                                    ]
                                                    )
                                                    ],
                                      
                                         
                                         //    'address_id',
                                         //       'license',
                                
                                            ['class' => 'yii\grid\ActionColumn'],
                                        ],
                                    ]); ?>
<?php Pjax::end(); ?></div></div></div>
