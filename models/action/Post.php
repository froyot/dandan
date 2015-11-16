<?php
namespace app\models\action;
use app\models\db\Posts;


class Post extends Posts
{

    public function getPostExtra()
    {
        return $this->hasOne(TermRelationship::className(),['object_id'=>'id']);
    }
}
