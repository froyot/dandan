<?php

namespace easydandan;
use Yii;
use easydandan\models\action\Module;
/**
 * easydandan module definition class
 */
class DandanModule extends \yii\base\Module
{

    const VERSION = 0.9;

    public $settings;
    public $activeModules;
    public $controllerLayout = '@easydandan/views/layouts/main';

    private $_installed;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'easydandan\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        //查询已经安装的模块
        $this->activeModules = Module::findAllActive();

        //注册模块
        $modules = [];
        foreach ($this->activeModules as $name => $module) {
            $modules[$name]['class'] = $module->class;
            if (is_array($module->settings)) {
                $modules[$name]['settings'] = $module->settings;
            }
        }
        $this->setModules($modules);

        // custom initialization code goes here
        // 定义常量，是否是超级管理员
        if (Yii::$app instanceof yii\web\Application) {
            define('IS_ROOT', !Yii::$app->admin->isGuest && Yii::$app->admin->identity->isRoot());
        }
    }
}
