<?php
namespace app\models\action;
use app\models\db\Posts;
use Yii;
use yii\helpers\ArrayHelper;

class Post extends Posts {
    public $cat_id;

    public function attributes() {
        // add related fields to searchable attributes
        return ArrayHelper::merge(parent::attributes(), ['cat_id']);
    }

    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            ['cat_id', 'required', 'on' => 'post',
                'message' => Yii::t('app', 'cat') . ' ' . Yii::t('app', 'not allow empty')],

            [['post_title', 'post_content'], 'required', 'on' => ['post', 'page']],

            ['post_type', 'default', 'value' => 'post', 'on' => 'post'],

            ['post_type', 'default', 'value' => 'page', 'on' => 'page'],

            [['post_author', 'post_status', 'comment_status',
                'post_parent', 'comment_count',
                'istop', 'recommended'], 'integer', 'on' => 'post'],

            [['recommended', 'comment_status', 'istop'], 'default',
                'value' => 0, 'on' => 'post'],

            [['post_status', 'istop'], 'default', 'value' => 0],

        ]);
    }

    public function attributeLabels() {
        $label = parent::attributeLabels();
        foreach ($label as $key => $item) {
            $label[$key] = Yii::t('app', $key);
        }
        return $label;
    }

    /**
     * post category relation
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:19:38+0800
     */
    public function getPostExtra() {
        return $this->hasOne(TermRelationship::className(), ['object_id' => 'id']);
    }

    /**
     * post author relation
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:19:59+0800
     */
    public function getAuthor() {
        return $this->hasOne(User::className(), ['id' => 'post_author']);
    }

    public function init() {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterDataInsert']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterDataUpdate']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'afterDataDelete']);
    }

    //保存文章和页面
    public function saveTextPost() {
        $this->getAbstructTxt();
    }

    /**
     * 获取文章摘要
     * @return [type] [description]
     */
    private function getAbstructTxt() {
        if ($this->post_excerpt) {
            $this->post_excerpt = mb_substr($this->post_excerpt, 0, Yii::$app->params['POST_EXCERPT_LENGTH']);
        } else {
            $this->post_excerpt = mb_substr($this->post_content, 0, Yii::$app->params['POST_EXCERPT_LENGTH']);
        }
    }

    /**
     * 插入前操作
     * @param  [type] $insert [description]
     * @return [type]         [description]
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {

            $this->post_author = Yii::$app->user->getId();
            return true;
        }
    }

    /**
     * 插入后，添加分类关联
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterDataInsert($event) {
        if ($this->getScenario() == 'post') {
            $termRelationship = new TermRelationship();
            $termRelationship->attributes = [
                'object_id' => $event->sender->getPrimaryKey(),
                'term_id' => $event->sender->cat_id,
            ];
            $termRelationship->save();
        }
    }

    /**
     * 更新后，更新分类关联表，分类文章数目
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterDataUpdate($event) {
        if ($this->getScenario() == 'post') {
            $termRelationship = TermRelationship::find()
                ->where(['object_id' => $event->sender->getPrimaryKey()])
                ->select(['term_id'])
                ->one();
            if ($termRelationship &&
                $termRelationship->term_id != $event->sender->cat_id) {
                $termRelationship->term_id = $event->sender->cat_id;
            }
            $termRelationship->save();
        }
    }
    /**
     * 更新后，更新分类关联表
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function afterDataDelete($event) {
        if ($this->getScenario() == 'post') {
            $termRelationship = TermRelationship::find()
                ->where(['object_id' => $event->sender->getPrimaryKey()])
                ->select(['tid', 'term_id'])
                ->one();
            if ($termRelationship) {
                $termRelationship->delete();
            }
        }
    }
    /**
     * get all pages
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:21:14+0800
     * @return   array                   array of page mode
     */
    public static function getPages() {
        return self::find()->where(['post_type' => 'page'])->all();
    }
}
