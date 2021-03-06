<?php

namespace app\models\form;

use app\models\action\Nav;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * NavForm represents the model behind the search form about `app\models\action\Nav`.
 */
class NavForm extends Nav {
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
            [['id', 'parentid', 'listorder'], 'integer'],
            [['label', 'target', 'href', '_keywords'], 'safe'],
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
        $query = Nav::find();

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
            'id' => $this->id,
            'parentid' => $this->parentid,
            'listorder' => $this->listorder,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
              ->andFilterWhere(['like', 'target', $this->target])
              ->andFilterWhere(['like', 'href', $this->href]);
        if ($this->_keywords) {
            $query->andFilterWhere(['like', 'label', $this->_keywords]);
        }

        return $dataProvider;
    }
}
