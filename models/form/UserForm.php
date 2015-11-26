<?php

namespace app\models\form;

use app\models\action\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * UserForm represents the model behind the search form about `app\models\action\User`.
 */
class UserForm extends User {
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
            [['id', 'sex', 'user_status', 'score', 'user_type', 'coin'], 'integer'],
            [['user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url', 'avatar', 'birthday', 'signature', 'last_login_ip', 'last_login_time', 'create_time', 'user_activation_key', 'mobile', '_keywords'], 'safe'],
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
        $query = User::find()->joinWith('authAssignment');

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
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'last_login_time' => $this->last_login_time,
            'create_time' => $this->create_time,
            'user_status' => $this->user_status,
            'score' => $this->score,
            'user_type' => $this->user_type,
            'coin' => $this->coin,
        ]);

        $query->andFilterWhere(['like', 'user_login', $this->user_login])
              ->andFilterWhere(['like', 'user_nicename', $this->user_nicename])
              ->andFilterWhere(['like', 'user_email', $this->user_email])
              ->andFilterWhere(['like', 'mobile', $this->mobile]);

        if ($this->_keywords) {
            $query->andFilterWhere([
                'or',
                ['like', 'user_login', $this->_keywords],
                ['like', 'user_nicename', $this->_keywords],
                ['like', 'user_email', $this->_keywords],
            ]);
        }

        return $dataProvider;
    }
}
