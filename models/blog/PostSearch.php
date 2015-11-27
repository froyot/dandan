<?php

namespace app\models\blog;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\blog\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\blog\Post`.
 */
class PostSearch extends Post
{
    public $title;
    public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['title']);

    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['content'], 'safe'],
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
        $query = Post::find()->joinWith('relations')->orderBy('date desc,id desc');

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
            'id' => $this->id,
            'date' => $this->date,
        ]);
        if(isset($params['category_id']))
        $query->andFilterWhere([
            'category_id' => $params['category_id'],
        ]);
        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
