<?php

namespace admin;
use Yii;
/**
 * andan module definition class
 */
class Module extends \yii\base\Module
{

    public function beforeAction($action)
    {
        $this->layout = 'main'; //your layout name
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // //查询已经安装的模块
        // $this->activeModules = Module::findAllActive();

        // //注册模块
        // $modules = [];
        // foreach ($this->activeModules as $name => $module) {
        //     $modules[$name]['class'] = $module->class;
        //     if (is_array($module->settings)) {
        //         $modules[$name]['settings'] = $module->settings;
        //     }
        // }
        // $this->setModules($modules);

        // // custom initialization code goes here
        // // 定义常量，是否是超级管理员
        // if (Yii::$app instanceof yii\web\Application) {
        //     define('IS_ROOT', !Yii::$app->admin->isGuest && Yii::$app->admin->identity->isRoot());
        // }
    }
}
