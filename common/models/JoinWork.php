<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "join_work".
 *
 * @property integer $id
 * @property integer $datetime_begin
 * @property integer $datetime_end
 * @property integer $request
 * @property integer $user_id
 * @property integer $work_id
 *
 * @property User $user
 * @property Work $work
 */
class JoinWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'join_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime_begin', 'datetime_end', 'request', 'user_id', 'work_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['work_id'], 'exist', 'skipOnError' => true, 'targetClass' => Work::className(), 'targetAttribute' => ['work_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime_begin' => 'เวลาเริ่มงาน',
            'datetime_end' => 'เวลาเลิกงาน',
            'request' => 'Request',
            'user_id' => 'User ID',
            'work_id' => 'Work ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::className(), ['id' => 'work_id']);
    }
}
