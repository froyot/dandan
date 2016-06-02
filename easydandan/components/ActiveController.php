<?php
namespace easydandan\components;

use Yii;

use yii\helpers\Url;
use yii\web\HttpNotFoundException;
use yii\base\InvalidConfigException;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use easydandan\behaviors\SortableBehavior;
use easydandan\behaviors\StatusBehavior;
use yii\helpers\ArrayHelper;
/**
 * Base dandan controller component
 * @package yii\dandan\components
 */
class ActiveController extends Controller
{

    public $modelClass;
    public $isSortable = false;
    public $isStatusable = false;
    public $checkAccess;

    public function actions()
    {
        return [
            'index' => [
                'class' => 'easydandan\actions\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'isSortable'=>$this->isSortable,
            ],
            'create' => [
                'class' => 'easydandan\actions\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
        ];

    }


    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [
                'class' => SortableBehavior::className(),
                'model' => $this->modelClass,

            ],
            [
                'class' => StatusBehavior::className(),
                'model' => $this->modelClass,
            ],
        ]);
    }


    /**
     * 向上移动排序
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-06-01T20:46:52+0800
     * @return   [type]                   [description]
     */
    public function actionUp($id)
    {

        if(!$this->isSortable)
        {
            throw new Exception($this->modelClass." not support sort", 1);
        }
        else
        {
            return $this->move($id, 'up');
        }
    }

    /**
     * 向下移动
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-06-01T20:47:09+0800
     * @return   [type]                   [description]
     */
    public function actionDown($id)
    {

        if(!$this->isSortable)
        {
            throw new Exception($this->modelClass." not support sort", 1);
        }
        else
        {
            return $this->move($id, 'down');
        }
    }

    /**
     * 状态开启
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-06-01T20:47:18+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function actionOn($id)
    {

        return $this->changeStatus($id, StatusBehavior::STATUS_ON);
    }

    /**
     * 状态关闭
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-06-01T20:47:27+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function actionOff($id)
    {
        return $this->changeStatus($id, StatusBehavior::STATUS_OFF);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        return true;
    }

}
