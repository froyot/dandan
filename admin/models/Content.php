<?php

namespace app\admin\models;
use Yii;
use app\models\db\Content as ContentModel;
use yii\helpers\ArrayHelper;

class Content extends ContentModel
{
    public $category;
    private $oldCategory;

    public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['category']);
    }

    public function rules(){
        return ArrayHelper::merge(parent::rules(),[
            [['created_at'],'default','value'=>date('Y-m-d H:i:s')],
            [['created_by'],'default','value'=>Yii::$app->user->id],
            ['category','default','value'=>0],
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

    public function afterSave($insert, $changedAttributes)
    {
          parent::afterSave($insert, $changedAttributes);
              //更新分类
          Relation::updateContentCategory(
              $this->primaryKey,
              $this->category,
              $this->oldCategory
            );
          return true;
    }

    public function afterFind()
    {
      $parName = Params::tableName();
      $relationName = Relation::tableName();
      $param = Content::find()
                ->joinWith('relations')
                ->joinWith('relations.param')
                ->where([
                  $relationName.'.content_id'=>$this->primaryKey,
                  $parName.'.type'=>'cat'
                  ])
                ->select([$parName.'.*'])
                ->one();
      if( $param )
      {
        $this->oldCategory = $param->id;
        return $this->category = $param->id;
      }
      $this->oldCategory = 0;
      $this->category = 0;
    }

    public function afterDelete()
    {
      //删除其他关联数据
      Relation::deleteAll(['content_id'=>$this->id]);
      Config::deleteSlide($this->id);
    }

}
