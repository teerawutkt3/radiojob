<?php

namespace frontend\controllers;

use common\models\Fulladdress;

class MapController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $contacts = Fulladdress::find()->all();
        
        return $this->render('index',['contacts'=>$contacts]);
    }

}
