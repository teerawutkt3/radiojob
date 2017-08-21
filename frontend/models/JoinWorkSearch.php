<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\JoinWork;

/**
 * JoinWorkSearch represents the model behind the search form about `common\models\JoinWork`.
 */
class JoinWorkSearch extends JoinWork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'datetime_begin', 'datetime_end', 'request', 'user_id', 'work_id'], 'integer'],
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
        $query = JoinWork::find();

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
            'datetime_begin' => $this->datetime_begin,
            'datetime_end' => $this->datetime_end,
            'request' => $this->request,
            'user_id' => $this->user_id,
            'work_id' => $this->work_id,
        ]);

        return $dataProvider;
    }
}
