<?php

namespace app\models\Search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'parent.name'], 'safe'],            
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
        $query = Category::find();

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
            'parent_id' => $this->parent_id,
            'state' => $this->state,
            'categories.user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        
        $query->leftJoin('categories parent', 'parent.id = categories.parent_id')->all();
        
        

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'parent.name', $this->getAttribute('parent.name')]);

        //$query->andFilterWhere(['like', 'parent.name', $this->getAttribute('parent.name')]);

        $dataProvider->sort->attributes['parent.name'] = [
            'asc' => ['parent.name' => SORT_ASC],
            'desc' => ['parent.name' => SORT_DESC],
        ];


        return $dataProvider;
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['parent.name']);
    }
}
