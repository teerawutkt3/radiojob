<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $description
 * @property integer $time_begin
 * @property integer $time_end
 * @property integer $money1
 * @property integer $money2
 * @property integer $create_at
 * @property integer $user_id
 *@property integer $province_id
* 
 *  * @property integer $geo_id
 * 
 *
 * @property User $user
 */
class Work extends \yii\db\ActiveRecord
{
    public $geo_id,$province_id,$amphur_id,$district_id;
    public  $nameSearch;
    public  $province;
      /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['create_at'],
                ],
            ],
        ];
    }
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['time_begin', 'time_end', 'money1'], 'required'],
            [[ 'money1', 'money2', 'create_at', 'user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'รายละเอียด',
            'time_begin' => 'เวลาเริ่มงาน',
            'time_end' => 'เวลาเลิกงาน',
            'money1' => 'เงินเดือน / บาท',
            'money2' => 'เงือนเดิน',
            'create_at' => 'เวลาประกาศ',
            'user_id' => 'ผู้ประกาศ',
            'nameSearch' => 'ผู้ประกาศ',
            'geo_id' => '',
            'province_id' => '',
            'amphur_id' => '',
            'distrcit_id' => '',
            'province' => '',
            'user.address.address_full' => 'ที่อยู่'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }
    
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    
    public function getRange(){
        return $this->money1." - ".$this->money2;
    }
}
