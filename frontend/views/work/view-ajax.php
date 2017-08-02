<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Work */
?>

				
  					
<div class="work-view">
							
        				 <?=  DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                            //    'id',
                                'description:ntext',
                                [
                                    'attribute' => 'time_begin',
                                    'value' => Yii::$app->formatter->asTime($model->time_begin,'medium')
                                ],
                                [
                                    'attribute' => 'time_end',
                                    'value' => Yii::$app->formatter->asTime($model->time_end,'medium')
                                ],
                                [
                                    'attribute' => 'created_at',
                                    'value' => Yii::$app->formatter->asTime($model->created_at,'medium')
                                ],
                    
                                'money1',
                                'money2',
                                [
                                    'attribute' => 'created_at',
                                    'value' => Yii::$app->formatter->asDatetime($model->created_at,'medium')
                                ],
                                'user.fname',
                             
                                'user.address.address_full'
                                
                            ],
                        ])  ?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <?= Html::a('สมัคร ', ['#'], ['class' => '  btn btn-block btn-warning']) ?>
                        </div>
                        <div class="col-md-4"></div>
                       
                      
</div>
