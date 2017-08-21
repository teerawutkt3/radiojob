<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Work;
use common\components\MyDate;

/**
 * WorkSearch represents the model behind the search form about `common\models\Work`.
 */
class WorkSearch extends Work
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time_begin', 'time_end', 'money1', 'money2', 'create_at', 'user_id'], 'integer'],
     //      [['description',' nameSearch'], 'safe'],
            [['description', 'time_begin', 'time_end','nameSearch','province_id','province,create_at'], 'safe'],
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
        $query = Work::find();
        $query->joinWith(['user']);
     //   $query->joinWith(['address']);
   //     $query->joinWith(['districts']);
  //      $query->joinWith(['amphures']);
   //     $query->joinWith(['provinces']);
   //     $query->joinWith(['geography']);
        
                      
        
       

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
            'id' => $this->id,
            'time_begin' => $this->time_begin,
            'time_end' => $this->time_end,
        //    'money1' => $this->money1,
          //  'money2' => $this->money2,
          //  'created_at' => $this->created_at,
         //   'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
                     ->andFilterWhere(['like','user.fname',$this->nameSearch])
                     ->andFilterWhere(['like','user.address.province.PROVINCE_ID',$this->province]);
        
                    if (!empty($this->money1) ){
                         $query->andFilterWhere(['>=','money1',$this->money1]);
                     }
                     if (!empty($this->money2) ){   
                         $query->andFilterWhere(['>=','money2',$this->money2]);
                     }
                     if (!empty($this->created_at) ){
                         $query->andFilterWhere(['>=','create_at',MyDate::TimeDigit2int($this->created_at)]);
                     }
                     
                     if (!empty($params['worksearch-create_at_convert'])){
                         $query->andFilterWhere(['>=','create_at',MyDate::TimeDigit2int($params['worksearch-create_at_convert'])]);
                     }

        return $dataProvider;
    }
}
