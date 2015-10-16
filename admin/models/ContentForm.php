<?php

namespace app\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ContentForm represents the model behind the search form about `app\models\db\Content`.
 */
class ContentForm extends Content
{
    public $_keyword;//keyword to search

    public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['_keyword']);

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['created_at', 'updated_at', 'title', 'content', 'others'], 'safe'],
            ['_keyword','string'],
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
        $query = Content::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'others', $this->others]);

        if( $this->_keyword )
        {
            $query->andWhere([
                'or',
                 ['like','title',$this->_keyword],
                 ['like','content',$this->_keyword]
            ]);
        }

        return $dataProvider;
    }
}
