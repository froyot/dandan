<?php

namespace app\admin\models;
use Yii;
use app\models\db\Content as ContentModel;
use yii\helpers\ArrayHelper;


class Content extends ContentModel
{

    public function rules(){
        return ArrayHelper::merge(parent::rules(),[
            [['created_at'],'default','value'=>date('Y-m-d H:i:s')],
            [['created_by'],'default','value'=>Yii::$app->user->id]
        ]);
    }
    public function beforeSave($insert)
    {
          if (parent::beforeSave($insert)) {
              $this->updated_at = date('Y-m-d H:i:s');
              $this->updated_by = Yii::$app->user->id;
              return true;
          } else {
              return false;
          }
    }

}
