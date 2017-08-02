<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use wattanapong\datetime\DateTimePicker;
use kartik\nav\NavX;
use kartik\tabs\TabsX;
?>


     
<div class="container">
			 	<div class="row">
             		<div class="col-md-10"></div>
             		<div class="col-md-2">
             					<div class="form-group">
                     					 <?= Html::a('<span class="glyphicon glyphicon-envelope"></span> ', [''], ['class' => '  btn btn-danger']) ?>
                     					  <?php // Html::a('<span class="glyphicon glyphicon-list-alt"></span> ', ['/work/hospital'], ['class' => '  btn btn-warning']) ?>
                     					 <?= Html::a('<span class="glyphicon glyphicon-file"></span>+ ', ['/work/create'], ['class' => '  btn btn-success']) ?>
             					 </div>
             		</div>
                    
                  </div>
            <div class="panel panel-default">
                    	 <div class="panel-heading"><h3 >ชื่อโรงพยาบาล</h3></div>
                          <div class="panel-body ">
                                 <?php Pjax::begin([
		'enablePushState'=>false
]); ?>  
                                   
                                       		 <?php 
                                                       
                                                          echo TabsX::widget([
                                                              'position' => TabsX::POS_ABOVE,
                                                              'align' => TabsX::ALIGN_LEFT,
                                                              'items' => [
                                                                  [
                                                                      'label' => 'ทั้งหมด',
                                                                      'content' => GridView::widget([
                                                                          'dataProvider' => $dataProvider,
                                                                          'filterModel' => $searchModel,
                                                                          'columns' => [
                                                                              ['class' => 'yii\grid\SerialColumn'],
                                                                              
                                                                              
                                                                              //   'id',
                                                                              'description',
                                                                              'money1',
                                                                              'money2',
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
                                                                                      'user.fname',
                                                                                      
                                                                                      ['class' => 'yii\grid\ActionColumn'],
                                                                                      ],
                                                                                            ])
                                                                                           ,
                                                                      'active' => true
                                                                  ],
                                                                  [
                                                                      'label' => 'Joins',
                                                                      'content' => 'การร่วมงาน',
                                                                      'headerOptions' => ['style'=>'font-weight:bold'],
                                                                      'options' => ['id' => 'myveryownID'],
                                                                  ],    
                                                            
                                                  ],] );?>
                                       
                                    <?php Pjax::end(); ?>
                        </div>
                  
            </div>
</div>
	
