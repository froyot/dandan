<?php
namespace easydandan\components;

use Yii;

use yii\helpers\Url;
use yii\web\HttpNotFoundException;
use yii\base\InvalidConfigException;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
/**
 * Base dandan controller component
 * @package yii\dandan\components
 */
class ActiveController extends Controller
{
    public $modelClass;
    public $checkAccess;

    public function actions()
    {
        return [
            'index' => [
                'class' => 'easydandan\actions\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
        ];

    }

    public function checkAccess($action, $model = null, $params = [])
    {
        return true;
    }

}
