<?php

namespace app\models\front\form;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Content as ContentModel;

/**
 * Content represents the model behind the search form about `app\models\db\Content`.
 */
class ContentForm extends ContentModel
{
    public $limitNum = 0;
    public $tags;
    public $category;
    public $isSlide;

    public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['tags','category','isSlide','limitNum']);

    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_by'], 'integer'],
            [['created_at', 'update_at', 'title', 'content', 'others','tags','category'], 'safe'],
            ['isSlide','boolean']
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
        $query = ContentModel::find();
        $query->joinWith('relations');
        $query->joinWith('relations.param');

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
            'update_at' => $this->update_at,
            'create_by' => $this->create_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'others', $this->others]);

        if( $this->isSlide !== null )
        {
            if( $this->isSlide == true )
            {
                $query->andFilterWhere([
                    'params.type'=>'slide'
                ]);
            }
            else
            {
                $query->andWhere("params.type!='slide' or params.type is null");
            }

        }

        return $dataProvider;
    }
}
