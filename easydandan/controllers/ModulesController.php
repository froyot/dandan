<?php

namespace easydandan\controllers;

use easydandan\components\ActiveController;
use yii\helpers\ArrayHelper;

use easydandan\behaviors\CurdBehavior;
/**
 * 模块管理控制器
 */
class ModulesController extends ActiveController
{

    public $modelClass = "easydandan\models\action\Module";
    public $isSortable = true;
    public $isStatusable = false;
}
