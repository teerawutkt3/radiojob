<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Map', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'MAP_ID',
            'LAT',
            'LONG',
            'DISTRCIT_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php 

$coord = new LatLng(['lat'=>13.777234,'lng'=>100.561981]);
$map = new Map([
    'center'=>$coord,
    'zoom'=>6,
    'width'=>'100%',
    'height'=>'600',
]);
foreach($contacts as $c){
    $coords = new LatLng(['lat'=>$c->lat,'lng'=>$c->lng]);
    $marker = new Marker(['position'=>$coords]);
    $marker->attachInfoWindow(
        new InfoWindow([
            'content'=>'
            
            <h4>'.$c->firstname.' '.$c->lastname.'</h4>
              <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>ที่อยู่</td>
                    <td>'.$c->address.'</td>
                </tr>
                <tr>
                    <td>ตำบล</td>
                    <td>'.$c->tambon->tambon_name.'</td>
                </tr>
                <tr>
                    <td>อำเภอ</td>
                    <td>'.$c->tambon->district->district_name.'</td>
                </tr>
                <tr>
                    <td>จังหวัด</td>
                    <td>'.$c->tambon->province->province_name.'</td>
                </tr>
                <tr>
                    <td>อีเมลล์</td>
                    <td>'.$c->email.'</td>
                </tr>
              </table>
            
        '
        ])
        );
    
    $map->addOverlay($marker);
}
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> การแสดงแผนที่ Google Map จากฐานข้อมูล</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $map->display();
        ?>
    </div>
</div>
?>
