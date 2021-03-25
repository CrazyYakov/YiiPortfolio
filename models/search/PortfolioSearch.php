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
            [['id', 'image_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link', 'description', 'category.name'], 'safe'],
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
            'portfolio.id' => $this->id,
            'portfolio.category_id' => $this->category_id,
            'portfolio.image_id' => $this->image_id,
            'portfolio.state' => $this->state,
            'portfolio.created_at' => $this->created_at,
            'portfolio.updated_at' => $this->updated_at,
        ]);

        $query->leftJoin('categories category', 'category.id = portfolio.category_id')->all();

        $query->andFilterWhere(['like', 'portfolio.name', $this->name])
            ->andFilterWhere(['like', 'portfolio.link', $this->link])
            ->andFilterWhere(['like', 'portfolio.description', $this->description])
            ->andFilterWhere(['like', 'category.name', $this->getAttribute('category.name')]);


        $dataProvider->sort->attributes['category.name'] = [
            'asc' => ['category.name' => SORT_ASC],
            'desc' => ['category.name' => SORT_DESC],
        ];

        return $dataProvider;
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.name']);
    }
}
