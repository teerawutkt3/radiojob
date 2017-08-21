<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->fname;


?>
<style>
div.caption:hover {
    background-color: #F0FFFF;
}
a.underline:hover {
    text-decoration: none;
}
.panel-body {
background: 	#DDDDDD;}


</style>
<div class="user-view">
				 <div class="panel panel-default">
                    	 <div class="panel-heading"><h3 >โปรไฟล์</h3></div>
                          <div class="panel-body ">
                          		<div class="row">
                          				<div class="col-md-11"></div>
                          				<div class="col-md-1">
                          							 <p>
                                                        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?php // Html::a('Delete', ['delete', 'id' => $model->id], [
                                                         /*    'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ]) */ ?>
                                 				   </p>
                          				</div>
                          		</div>
                                   
                                
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                      //      'id',
                                            'username',
                                            'fname',
                                            'lname',
                                   /*          'fb_id',
                                            'auth_key',
                                            'password_hash',
                                            'password_reset_token', */
                                            'email:email',
                                       //     'status',
                                            [
                                                'attribute' => 'created_at',
                                                'value' => Yii::$app->formatter->asDatetime($model->created_at,'medium')
                                            ],
                                            [
                                                'attribute' => 'updated_at',
                                                'value' => Yii::$app->formatter->asDatetime($model->updated_at,'medium')
                                            ],
                                            'address.address_full',
                                /*             [
                                                'attribute' => 'address_id',
                                                'value' => function($model){
                                                return $model->address->getAddress_full();
                                                },
                                                'format' => 'html'
                                                     ]*/
                                                    
                                        ],
                                    ]) ?>
			</div>
			</div>
</div>
