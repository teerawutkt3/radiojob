<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Map;

/**
 * MapSearch represents the model behind the search form about `common\models\Map`.
 */
class MapSearch extends Map
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MAP_ID', 'DISTRCIT_ID'], 'integer'],
            [['LAT', 'LONG'], 'number'],
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
        $query = Map::find();

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
            'MAP_ID' => $this->MAP_ID,
            'LAT' => $this->LAT,
            'LONG' => $this->LONG,
            'DISTRCIT_ID' => $this->DISTRCIT_ID,
        ]);

        return $dataProvider;
    }
}
