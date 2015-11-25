<?php

namespace app\models\form;

use app\models\action\slide;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * slideForm represents the model behind the search form about `app\models\action\slide`.
 */
class slideForm extends slide {
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
            [['slide_id', 'slide_cid', 'listorder'], 'integer'],
            [['slide_name', 'slide_pic', 'slide_des', '_keywords'], 'safe'],
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
        $query = slide::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'slide_id' => $this->slide_id,
            'slide_cid' => $this->slide_cid,
            'listorder' => $this->listorder,
        ]);

        $query->andFilterWhere(['like', 'slide_name', $this->slide_name])
              ->andFilterWhere(['like', 'slide_pic', $this->slide_pic])

              ->andFilterWhere(['like', 'slide_des', $this->slide_des]);

        return $dataProvider;
    }
}
