<?php

namespace easydandan\controllers;
use Yii;
use easydandan\components\ActiveController;
use yii\helpers\ArrayHelper;

use easydandan\behaviors\CurdBehavior;
use easydandan\models\action\Module;
/**
 * 模块管理控制器
 */
class ModulesController extends ActiveController
{

    public $modelClass = "easydandan\models\action\Module";
    public $isSortable = true;
    public $isStatusable = false;

    public function actionSetting($id)
    {
        $model = Module::find()->where(['module_id'=>$id])->one();
        if(!$model)
        {

        }

        if(Yii::$app->request->isPost)
        {
            $settings = $model->settings;
            $newSettings = Yii::$app->request->post('Settings');
            //布尔值类型转换
            if(is_array($settings) && is_array($newSettings))
            {
                foreach ($settings as $key => $setting) {
                    if(is_bool($setting))
                    {
                        $newSettings[$key] = $model->settings[$key]?true:false;
                    }
                }
            }
            $model->settings= $newSettings;
            if( $model->validate() && $model->save() )
            {
                return $this->redirect($this->getReturnUrl());
            }

        }
        return $this->render('setting',['model'=>$model]);
    }
}
