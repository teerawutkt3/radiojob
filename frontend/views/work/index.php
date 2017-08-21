<?php

use yii\helpers\Html;
use kartik\slider\Slider;
use kartik\range\RangeInput;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\Geography;
use yii\web\View;
use yii\helpers\Url;
use kartik\label\LabelInPlace;

/* @var $searchModel frontend\models\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs('
    function listProvinces(){
    var geo_id = $("#geo_id").val();
    $.ajax({
        url:"'.Url::toRoute("address/list_provinces").'",
        method: "GET",
         data: { id: geo_id }
    }).done(function(txt){
        $("#province_id").html(txt);
    });
    
    }

    function loadWork(id){
    $.ajax({
        url:"'.Url::toRoute("/work/view-ajax?id=").'"+id,
        method: "GET",
    }).done(function(txt){
        $("#data").html(txt);
    });

return false;
    }
    
',
    View::POS_END);
?>
<style>
div.caption:hover {
    background-color: #F0FFFF;
}
a.underline:hover {
    text-decoration: none;
}
.panel-body {
background: 	#DDDDDD;
}
       .list-group-custom {
                
                    background-color: 	#003366;
                    
           }


</style>

<?php 
$this->title = 'Works';
//$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
    		<!-- 	<div class="col-md-4"></div> -->
    			<div class="col-md-10"></div>
    			<div class="col-md-2">
    			    <?= Html::a('ค้นหาแบบแผนที่ <span class="glyphicon glyphicon-globe"></span>', ['/map/index'], ['class' => 'btn-block  btn btn-danger']) ?>
                    <h1><?php // Html::encode("หางาน") ?></h1>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    			</div>
    			
    </div>
	
<?php Pjax::begin([
		'enablePushState'=>false
]); ?>  

    <div class="row">
    			<div class="col-md-12">
    					
                          		  <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
                           
                        			<ul class="list-group">
                        				<li class="list-group-item list-group-custom ">
                        					<div class="row"> 
                        					<div class="col-md-3">
                        				  <?= $form->field($searchModel, 'description')->widget(
                          				           LabelInPlace::className(),[
                          				                  'type'  => LabelInPlace::TYPE_TEXT
                          				           
                                                        ]) ?>
                                    		</div>
                                    	
                                            		<div class="col-md-3">
                                            			
                                       				 	<?php
                                       				 	echo $form->field($searchModel, 'money1')->widget(Slider::classname(), [
                                       				 	    'sliderColor' => Slider::TYPE_INFO,
                                       				 	    'handleColor' => Slider::TYPE_PRIMARY,
                                       				 	    'pluginOptions'=>[
                                       				 	        'min'=>1000,
                                       				 	        'max'=>100000,
                                       				 	        'step'=>500
                                       				 	    ],
                                       				 	
                                       				 	]);
                                                	               
                                                                /*  echo RangeInput::widget([
                                                                    'model' => $searchModel,
                                                                    'attribute' => 'money1',
                                                                   
                                                                    'addon' => [
                                                                        'append' => [
                                                                            'content' => 'บาท / เดือน'
                                                                        ]
                                                                    ],
                                                                    'html5Options' => [
                                                                        'min' => 1000,
                                                                        'max' => 100000,
                                                                        'step' => 500
                                                                    ]
                                                                ]);  */
                                                                
                                                                
                                                                ?>
                                            		</div>
                                            	
                                    		</div>
                                    		<div class="row">
                                            		<div class="col-md-3">
                                                		<?= $form->field($searchModel, 'geo_id')->dropDownList(
                                                        ArrayHelper::map(Geography::find()->all(), 'GEO_ID', 'GEO_NAME'),
                                                                    [
                                                                      
                                                                        'id' => 'geo_id',
                                                                        'prompt' => 'ภาค',
                                                                        'onChange'=>'listProvinces()'
                                                                    ] ) ?>
                                                     </div> 	<div class="col-md-3">
                                         							<?= $form->field($searchModel, 'province')-> dropDownList([],
                                                            		[	
                                                            				'id' => 'province_id',
                                                            				'prompt' => 'จังหวัด',
                                                            		      //    'onChange'=>'listAmphures()'
                                                            		    
                                                            		]) ?>
                                                            	
                                                            		</div>
                                                  	<div class="col-md-4"><br>
                                            		
                                            		 <?= Html::submitButton( 'ค้นหา <span class="glyphicon glyphicon-search"></span>' , ['class' => 'btn  btn-warning']) ?>
                                            		</div>
                                            	
                                 					
                 						    </div>
                        				</li>
								</ul>
			
					<?php \yii\widgets\ActiveForm::end(); ?>
    			</div>
   </div>
    <div class="panel ">
                    	 
                          <div class="panel-body   ">
            					<div class="row">
            							<div class="col-md-4">
            								<p class="text-center text-primary"> งานประกาศ _ <span class="glyphicon glyphicon-pencil"></span></p>
            								<ul class="list-group" style="height:600px; overflow:auto">
            													<?php $count=0;?>
                                            			<?php foreach($dataProvider->models as $model ){ ?>
                                            					<?php $count+=1;?>
                                            					<a class="card underline" href="#" onclick="return loadWork(<?= $model->id?>)">
                                            				<li class="list-group-item list-group-item-default ">
                                            						<div class="caption">
                                            								<?= $count; ?><span class="glyphicon glyphicon-home"> <?=$model->user->fname  ?></span>
                                            							<h3><?=$model->description?></h3>
                                            							<p>ช่วงเงินเดือน <?=$model->range?></p>
                                            							<p>ตำแหน่ง <?= $model->user->address->value
                                            							                             ."ต. " .$model->user->address->district->DISTRICT_NAME
                                            				                            			."อ. " .$model->user->address->amphur->AMPHUR_NAME
                                            							                            ."จ. " .$model->user->address->province->PROVINCE_NAME
                                            							                           //  .$model->user->address->amphur->AMPHUR_NAME
                                            							?></p>
                                            						
                                            						</div>	
                                            						</li>
                                            					</a>
                                            	
                                						<?php  }?>
                                						</ul>
        						</div>
        							<div class="col-md-8"  id="data">
        								<!-- 	data -->
        							</div>
        					</div> <!-- end div row -->
        			</div> <!-- end panel body -->
        		
    		
    </div>
<?php Pjax::end();?>




