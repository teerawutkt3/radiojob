<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$coord = new LatLng(['lat'=>13.777234,'lng'=>100.561981]);
$map = new Map([
    'center'=>$coord,
    'zoom'=>12,
    'width'=>'100%',
    'height'=>'600',
]);
foreach($contacts as $c){
  $coords = new LatLng(['lat'=>$c->LAT,'lng'=>$c->LONG]);  
  $marker = new Marker(['position'=>$coords]);
  $marker->attachInfoWindow(
    new InfoWindow([
        'content'=>'
     
            <h4>โรงพยาบาล</h4>
              <table class="table table-striped table-bordered table-hover">
                
                <tr>
                    <td>ตำบล</td>
                    <td>'.$c->DISTRICT_NAME.'</td>
                </tr>
                <tr>
                    <td>อำเภอ</td>
                    <td>'.$c->AMPHUR_NAME.'</td>
                </tr>
                <tr>
                    <td>จังหวัด</td>
                    <td>'.$c->PROVINCE_NAME.'</td>
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