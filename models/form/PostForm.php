<?php

namespace app\models\form;

use app\models\action\Post;
use app\models\action\TermRelationship;
use app\models\action\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * PostForm represents the model behind the search form about `app\models\action\Post`.
 */
class PostForm extends Post {
    public $_keywords;
    public $listorder;
    public $cat_name;
    public $cat_id;

    public function attributes() {
        // add related fields to searchable attributes
        return ArrayHelper::merge(parent::attributes(), ['_keywords', 'listorder', 'cat_name']);
    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'post_author', 'post_status', 'comment_status', 'post_parent', 'comment_count', 'istop', 'recommended', 'cat_id'], 'integer'],
            ['post_type', 'string'],
            [['post_date', 'post_content', 'post_title', 'post_excerpt', 'post_modified', 'post_content_filtered', 'post_mime_type', 'smeta', '_keywords'], 'safe'],
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
        $query = Post::find()->joinWith('postExtra');
        $postExtraTbName = TermRelationship::tableName();
        $authorTbName = User::tableName();
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
            'post_author' => $this->post_author,
            'post_date' => $this->post_date,
            'post_status' => $this->post_status,
            'comment_status' => $this->comment_status,
            'post_modified' => $this->post_modified,
            'post_parent' => $this->post_parent,
            'post_type' => $this->post_type,
            'comment_count' => $this->comment_count,
            'istop' => $this->istop,
            'recommended' => $this->recommended,
        ]);

        $query->andFilterWhere(['like', 'post_content', $this->post_content])
              ->andFilterWhere(['like', 'post_title', $this->post_title])
              ->andFilterWhere(['like', 'post_excerpt', $this->post_excerpt])
              ->andFilterWhere(['like', 'post_content_filtered', $this->post_content_filtered])
              ->andFilterWhere(['like', 'post_mime_type', $this->post_mime_type])
              ->andFilterWhere(['like', 'smeta', $this->smeta]);
        $query->andFilterWhere(['or',
            ['like', 'post_title', $this->_keywords],
            ['like', 'post_content', $this->_keywords],
            ['like', 'post_excerpt', $this->_keywords],
        ]);
        $query->orderBy('post_date desc');
        //过滤分类
        if ($this->cat_id) {
            $query->andFilterWhere([$postExtraTbName . '.term_id' => $this->cat_id]);
        }

        $dataProvider->sort->attributes['cat_name'] = [
            'asc' => [$postExtraTbName . '.term_id' => SORT_ASC],
            'desc' => [$postExtraTbName . '.term_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['listorder'] = [
            'asc' => [$postExtraTbName . '.listorder' => SORT_ASC],
            'desc' => [$postExtraTbName . '.listorder' => SORT_DESC],
        ];
        return $dataProvider;
    }
}
