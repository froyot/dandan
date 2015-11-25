<?php

namespace app\models\form;

use app\models\action\Term;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * TermForm represents the model behind the search form about `app\models\action\Term`.
 */
class TermForm extends Term {
    public $_keywords;
    public function attributes() {
        // add related fields to searchable attributes
        return ArrayHelper::merge(parent::attributes(), ['_keywords']);
    }

    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(),
            [
                '_keywords' => Yii::t('app', 'keyword'),
            ]
        );
    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['term_id', 'parent', 'count', 'listorder'], 'integer'],
            [['name', 'slug', 'taxonomy', 'description', '_keywords'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Term::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'term_id' => $this->term_id,
            'parent' => $this->parent,
            'count' => $this->count,
            'listorder' => $this->listorder,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'slug', $this->slug])
              ->andFilterWhere(['like', 'taxonomy', $this->taxonomy])
              ->andFilterWhere(['like', 'description', $this->description]);
        if ($this->_keywords) {

            $query->andFilterWhere([
                'or',
                ['like', 'name', $this->_keywords],
                ['like', 'description', $this->_keywords],
            ]);
        }
        return $dataProvider;
    }
}
