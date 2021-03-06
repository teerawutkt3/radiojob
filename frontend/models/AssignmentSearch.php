<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AuthAssignment;
use common\components\MyDate;

/**
 * AssignmentSearch represents the model behind the search form about `common\models\AuthAssignment`.
 */
class AssignmentSearch extends AuthAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name','nameSearch'], 'safe'],
            [['user_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AuthAssignment::find()->alias('t');
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
        //    'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
                    ->andFilterWhere(['like','user.username',$this->nameSearch]);
                       // ->andFilterWhere('like','user.username',$this->nameSearch);
        if (!empty($this->created_at) ){
            $query->andFilterWhere(['>=','t.created_at',MyDate::TimeDigit2int($this->created_at)]);
        }
        
         if (!empty($params['assignmentsearch-created_at_convert'])){
            $query->andFilterWhere(['>=','t.created_at',MyDate::TimeDigit2int($params['assignmentsearch-created_at_convert'])]);
        }
 
        return $dataProvider;
    }
}
