<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\action\Guestbook;
use yii\helpers\ArrayHelper;

/**
 * GuestbookForm represents the model behind the search form about `app\models\action\Guestbook`.
 */
class GuestbookForm extends Guestbook
{
    public $_keywords;
    public function attributes()
    {
       // add related fields to searchable attributes
      return ArrayHelper::merge(parent::attributes(), ['_keywords']);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),
          [
              '_keywords' => Yii::t('app','keyword'),
          ]
        );
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['full_name', 'email', 'title', 'msg', 'createtime'], 'safe'],
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
        $query = Guestbook::find();

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
            'id' => $this->id,
            'createtime' => $this->createtime,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'msg', $this->msg]);

        return $dataProvider;
    }
}
