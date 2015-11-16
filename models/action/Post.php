<?php
namespace app\models\action;
use app\models\db\Posts;
use Yii;

class Post extends Posts
{
    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        foreach( $label as $key => $item )
        {
            $label[$key] = Yii::t('app',$key);
        }
        return $label;
    }

    public function getPostExtra()
    {
        return $this->hasOne(TermRelationship::className(),['object_id'=>'id']);
    }
}
