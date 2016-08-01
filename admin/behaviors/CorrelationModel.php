<?php
namespace admin\behaviors;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use admin\models\Correlation;
/**
 * key value make php array file
 * @inheritdoc
 */
class CorrelationModel extends \yii\base\Behavior
{
    public $saveCorrets;
    public $model;
    public $correlations;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveCorrelation',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveCorrelation',
            ActiveRecord::EVENT_AFTER_DELETE => 'removeCorrelation',
        ];
    }


    /**
     * 获取数据关联数据，一个
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-08-01T10:41:50+0800
     * @return   [type]                   [description]
     */
    public function getCorrelation($corModel)
    {
        return Correlation::findOne(['model'=>$this->model,'cor_model'=>$corModel,'model_id'=>$this->owner->getPrimaryKey()]);
    }

    /**
     * 获取数据关联数据，多个
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-08-01T10:41:50+0800
     * @return   [type]                   [description]
     */
    public function getCorrelations($corModel)
    {
        return Correlation::find()->where(['model'=>$this->model,'cor_model'=>$this->corModel,'model_id'=>$this->owner->getPrimaryKey()])->all();
    }

    public function getCorModels($corModelClass)
    {
        $model = Yii::createObject($corModelClass);
        return $model->find()->all();
    }
    /**
     * 删除关联数据
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-08-01T14:39:07+0800
     * @return   [type]                   [description]
     */
    public function removeCorrelation()
    {
        return Correlation::deleteAll(['model'=>$this->model,'model_id'=>$this->owner->getPrimaryKey()]);
    }

    /**
     * 保存关联数据
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-08-01T14:39:16+0800
     * @return   [type]                   [description]
     */
    public function saveCorrelation()
    {
        $_relates = [];
        if(is_callable($this->saveCorrets))
        {
            call_user_func_array($this->saveCorrets,array(&$_relates));
        }
        //删除旧的数据
        $this->removeCorrelation();
        foreach($_relates as $corModel =>$cor_model_id)
        {
            if($this->correlations[$corModel]['type'] == 'single')
            {
                $correlation = Correlation::findOne([
                    'model'=>$this->model,
                    'cor_model'=>$corModel,
                    'model_id'=>$this->owner->getPrimaryKey(),
                ]);
                if(!$correlation)
                {
                    $correlation = new Correlation();
                    $correlation->attributes = [
                        'model'=>$this->model,
                        'cor_model'=>$corModel,
                        'model_id'=>$this->owner->getPrimaryKey(),
                    ];
                }
                $correlation->cor_model_id = $cor_model_id;

            }
            else
            {
                $correlation = Correlation::findOne([
                    'model'=>$this->model,
                    'cor_model'=>$corModel,
                    'model_id'=>$this->owner->getPrimaryKey(),
                    'cor_model_id'=>$cor_model_id
                ]);
                if($correlation)
                {
                    return;
                }
                $correlation = new Correlation();
                $correlation->attributes = [
                        'model'=>$this->model,
                        'cor_model'=>$corModel,
                        'model_id'=>$this->owner->getPrimaryKey(),
                        'cor_model_id'=>$cor_model_id
                ];
            }
            $correlation->save();
        }

    }

}
