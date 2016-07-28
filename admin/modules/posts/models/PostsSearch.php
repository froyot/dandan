<?php

namespace admin\modules\posts\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\modules\posts\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `admin\modules\posts\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'create_at', 'update_at', 'author_id'], 'integer'],
            [['title', 'content', 'abstruct'], 'safe'],
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
        $query = Posts::find();

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
            'post_id' => $this->post_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'abstruct', $this->abstruct]);

        return $dataProvider;
    }
}
