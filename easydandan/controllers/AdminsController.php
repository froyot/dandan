<?php

namespace easydandan\controllers;
use Yii;
use easydandan\components\ActiveController;
use yii\helpers\ArrayHelper;

use easydandan\behaviors\CurdBehavior;
use easydandan\models\action\Module;
use yii\web\NotFoundHttpException;
/**
 * 管理员管理控制器
 */
class AdminsController extends ActiveController
{

    public $modelClass = "easydandan\models\action\Admin";
    public $isSortable = false;
    public $isStatusable = false;


}
