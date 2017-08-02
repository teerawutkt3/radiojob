<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "map".
 *
 * @property integer $MAP_ID
 * @property double $LAT
 * @property double $LONG
 * @property integer $DISTRCIT_ID
 *
 * @property Districts $dISTRCIT
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LAT', 'LONG'], 'number'],
            [['DISTRCIT_ID'], 'integer'],
            [['DISTRCIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['DISTRCIT_ID' => 'DISTRICT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MAP_ID' => 'Map  ID',
            'LAT' => 'Lat',
            'LONG' => 'Long',
            'DISTRCIT_ID' => 'Distrcit  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDISTRCIT()
    {
        return $this->hasOne(Districts::className(), ['DISTRICT_ID' => 'DISTRCIT_ID']);
    }
}
