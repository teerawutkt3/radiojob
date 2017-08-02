<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "address".

 * @property integer $id
 * @property string $value
 * @property integer $district_id
	* @property Districts $district
 * @property User[] $users
 */
class Address extends \yii\db\ActiveRecord
{
    public $amphur_id,$province_id,$geo_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_id'], 'integer'],
            [['value'], 'string'], 
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'DISTRICT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'district_id' => 'District ID',
            'geo_id' => '',
            'province_id'=>'',
            'amphur_id'=>'',
            'district_id'=>'',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * 
     */

    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['DISTRICT_ID' => 'district_id']);
    }
    public function getAmphur(){
        return $this->hasOne(Amphures::className(),['AMPHUR_ID' => 'AMPHUR_ID'])->via('district');
    }
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['PROVINCE_ID' => 'PROVINCE_ID'])->via('amphur');
    }
    public function getGeography()
    {
        return $this->hasOne(Geography::className(), ['GEO_ID' => 'GEO_ID'])->via('province');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress_full(){
        $full_address = $this->value." ต.". $this->district->DISTRICT_NAME;
        $full_address .= "อ.".$this->amphur->AMPHUR_NAME." จ.".$this->province->PROVINCE_NAME;
        //$full_address .= " ".$this->district->
        return $full_address;
    }
    
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['address_id' => 'id']);
    }
}
