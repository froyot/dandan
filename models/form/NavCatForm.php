<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\action\NavCat;
use yii\helpers\ArrayHelper;

/**
 * NavCatForm represents the model behind the search form about `app\models\action\NavCat`.
 */
class NavCatForm extends NavCat
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
       return
        [
            [['navcid', 'active'], 'integer'],
            [['name', 'remark','_keywords'], 'safe'],
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
        $query = NavCat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params,'');//去掉formName，避免链接过长
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'navcid' => $this->navcid,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        if( $this->_keywords )
        $query->andFilterWhere([
            'or',
            ['like','name', $this->_keywords],
            ['like','remark', $this->_keywords]
            ]);

        return $dataProvider;
    }
}
