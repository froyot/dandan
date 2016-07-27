<?php

namespace admin\modules\category\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\modules\category\models\Category;

/**
 * CategorySearch represents the model behind the search form about `admin\modules\category\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'parent_id', 'des', 'status', 'sort_num'], 'integer'],
            [['type', 'name', 'create_at'], 'safe'],
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
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cat_id' => $this->cat_id,
            'parent_id' => $this->parent_id,
            'des' => $this->des,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'sort_num' => $this->sort_num,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
