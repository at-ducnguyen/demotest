<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RestaurantUser;

/**
 * RestaurantUserSearch represents the model behind the search form about `backend\models\RestaurantUser`.
 */
class RestaurantUserSearch extends RestaurantUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cookie_id', 'user_id', 'restaurant_id', 'district_id', 'created_at', 'updated_at'], 'integer'],
            [['distance', 'no_suggestion'], 'number'],
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
        $query = RestaurantUser::find();

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
            'cookie_id' => $this->cookie_id,
            'user_id' => $this->user_id,
            'restaurant_id' => $this->restaurant_id,
            'district_id' => $this->district_id,
            'distance' => $this->distance,
            'no_suggestion' => $this->no_suggestion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
