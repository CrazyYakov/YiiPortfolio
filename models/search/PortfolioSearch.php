<?php

namespace app\models\Search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Portfolio;

/**
 * PortfolioSearch represents the model behind the search form of `app\models\Portfolio`.
 */
class PortfolioSearch extends Portfolio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'image_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Portfolio::find();

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
            'category_id' => $this->category_id,
            'image_id' => $this->image_id,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
