<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="work-view">
        	<div class="row">
        		<div class="col-md-10"></div>
        			<div class="col-md-2">
                        		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], ['class' => 'btn btn-circle btn-success']) ?>
                                 <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $model->id], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                            'confirm' => 'ต้องการลบงานประกาศหรือไม่',
                                                            'method' => 'post',
                                                        ],
                                  ]) ?>
                   </div>
             </div><br><br>
    <?=  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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

</div>
