<?php

namespace app\admin\models;
use Yii;
use app\models\db\Content as ContentModel;
use yii\helpers\ArrayHelper;
use app\models\db\Params as ParamsModel;

class Params extends ParamsModel
{
    /**
     * save category data
     * @return boolean
     */
    public function saveCategory()
    {
        $this->type = 'cat';
        $where = [
            'type'=>$this->type,
            'name'=>$this->name,
            ];
        if( !$this->isNewRecord )
        {
            $where[] = ['!=','id',$this->id];
        }
        if( ParamsModel::findOne($where) )
        {
            $this->addError('name','the same category is added');
            return false;
        }
        return parent::save();
    }

    /**
     * get all categorys
     * @return array category categorys
     */
    public function getCategorys()
    {
        return Params::find()->where([
                'type'=>'cat'
            ])
        ->select(['id','name'])
        ->asArray()->all();
    }
}
