<?php

namespace app\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\admin\models\Config;

/**
 * ConfigFrom represents the model behind the search form about `app\admin\models\Config`.
 */
class ConfigFrom extends Config
{
    public $_keyword;//search key word

    // add _keyword to attribute
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
            [['key', 'value'], 'safe'],
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
        $query = Config::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);
        $query->andFilterWhere([
            'or',
            ['like','key',$this->_keyword],
            ['like','value',$this->_keyword]
            ]);
        return $dataProvider;
    }
}
