<?php
/**
 * comment manage model
 */
namespace app\models\action;
use app\models\db\Comments as CommentDb;
use Yii;
use yii\helpers\ArrayHelper;

class Comment extends CommentDb {
    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            [['full_name', 'email'], 'required', 'on' => 'guest'],
            [['uid'], 'required', 'on' => 'user'],
            ['email', 'email'],
            [['content'], 'validateFrequence'], //验证频率
            ['createtime', 'default', 'value' => date('Y-m-d H:i:s')],
            ['post_table', 'default', 'value' => 'post'],
        ]);
    }

    public function attributeLabels() {
        $label = parent::attributeLabels();
        foreach ($label as $key => $item) {
            $label[$key] = Yii::t('app', $key);
        }
        return $label;
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * validateFrequence check same user comment same post frequence
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T15:05:33+0800
     * @param    string                   $attribute attribute name
     * @param    maixd                    $params    attribute value
     */
    public function validateFrequence($attribute, $params) {
        if (!$this->hasErrors()) {
            if ($this->uid) {
                $map = ['uid' => $this->uid];
            } else {
                $map = ['email' => $this->email];
            }
            $map['post_id'] = $this->post_id;

            $lastComment = Comment::find()
                ->where($map)
                ->orderBy('createtime desc')
                ->select(['createtime'])
                ->one();
            if ($lastComment) {
                $siteOption = Yii::$app->cacheManage->site_option;
                $commentInterval = $siteOption['comment_time_interval'];
                $time = time() - strtotime($lastComment->createtime);
                if ($time < $commentInterval) {
                    $this->addError(
                        'content',
                        Yii::t('app', 'you comment too faster')
                    );
                }
            }
        }
    }
}
