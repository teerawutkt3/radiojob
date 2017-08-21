<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use wattanapong\datetime\DateTimePicker;
use kartik\nav\NavX;
use kartik\tabs\TabsX;
use yii\helpers\Url;
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
                                                                              
                                                                              
                                                                                 'id',
                                                                              [
                                                                                  'attribute' =>'description',
                                                                                  'format' => 'html',
                                                                                  'value' => function($model){
                                                                                      $limit = 40;
                                                                                      if (strlen($model->description) > $limit )
                                                                                         return "<p title='".$model->description."'>".substr($model->description, 0,$limit)."...</p>";
                                                                                        return $model->description;
                                                                                  }
                                                                                ],
                                                                              'money1',
                                                                              'money2',
                                                                              [
                                                                                  'attribute' =>'created_at',
                                                                                  'format' => 'html',
                                                                                  'value' => function($model, $key, $index, $widget) {
                                                                                  return Yii::$app->formatter->asDatetime($model->create_at,"medium");
                                                                                  },
                                                                                  'filter' => DateTimePicker::widget(
                                                                                      [
                                                                                          'model' => $searchModel,
                                                                                          'attribute' => 'create_at',
                                                                                          //'value' => $searchModel->created_at,
                                                                                          'value' => Yii::$app->formatter->asDatetime($searchModel->create_at,"medium"),
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
                                                                                      'user.fname',
                                                                                      
                                                                                      [
                                                                                          'class' => 'yii\grid\ActionColumn',
                                                                                          'template' => '{view}{update}{delete}',
                                                                                          'buttons' => [
                                                                                              'view' => function($url,$model){
                                                                                                  return Html::a('    <span class="glyphicon glyphicon-eye-open"></span>
                                                                                            ',Url::toRoute('work/'.$model->id),[
                                                                                                    'target' => '_blank','data-pjax' => 0
                                                                                                ]);
                                                                                              },
                                                                                              'update' => function($url,$model){
                                                                                              return Html::a(' <span class="	glyphicon glyphicon-pencil"></span> ',Url::toRoute('work/update?id='.$model->id));},                                                                                
                                                                                              'delete' => function($url,$model){
                                                                                              return Html::a('<span class="		glyphicon glyphicon-trash"></span>',Url::toRoute('work/delete?id='.$model->id),[
                                                                                                  'data' => [
                                                                                                      'confirm' => 'ต้องการลยงานประกาศนี้หรือไม่',
                                                                                                      'method' => 'post',
                                                                                                  ],
                                                                                              ]);
                                                                                              }
                                                                                          ]
                                                                                          
                                                                                      ],
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
	
