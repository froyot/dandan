<?php

namespace app\models\form;

use app\models\action\slideCat;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * slideCatForm represents the model behind the search form about `app\models\action\slideCat`.
 */
class slideCatForm extends slideCat {
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
            [['cid', 'cat_is_default'], 'integer'],
            [['cat_name', 'cat_idname', 'cat_remark', '_keywords'], 'safe'],
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
        $query = slideCat::find();

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
            'cid' => $this->cid,
            'cat_is_default' => $this->cat_is_default,
        ]);

        $query->andFilterWhere(['like', 'cat_name', $this->cat_name])
              ->andFilterWhere(['like', 'cat_idname', $this->cat_idname])
              ->andFilterWhere(['like', 'cat_remark', $this->cat_remark]);
        if ($this->_keywords) {

            $query->andFilterWhere([
                'or',
                ['like', 'cat_name', $this->_keywords],
                ['like', 'cat_idname', $this->_keywords],
                ['like', 'cat_remark', $this->_keywords],
            ]);
        }

        return $dataProvider;
    }
}
