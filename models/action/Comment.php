<?php
namespace app\models\action;
use app\models\db\Comments as CommentDb;
use yii\helpers\ArrayHelper;

class Comment extends CommentDb
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
                [['full_name','email'],'required','on'=>'guest'],
                [['uid'],'required','on'=>'user'],
                ['email','email']
            ]);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'uid']);
    }
}
