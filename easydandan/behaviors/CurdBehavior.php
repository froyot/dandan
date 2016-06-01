<?php
namespace easydandan\behaviors;

use Yii;
use yii\helpers\Url;
use yii\web\HttpNotFoundException;
use yii\base\InvalidConfigException;
use yii\widgets\ActiveForm;
/**
 * Status behavior. Adds statuses to models
 * @package yii\easyii\behaviors
 */
class CurdBehavior extends \yii\base\Behavior
{
    const BEFORE_GET_LIST = "beforeGetList";
    const AFTER_GET_LIST = "afterGetList";


    const BEFORE_ADD = "beforeAdd";
    const AFTER_ADD = "afterAdd";

    const BEFORE_CREATE = "beforeCreate";
    const AFTER_CREATE = "afterCreate";

    const BEFORE_DELETE = "beforeDelete";
    const AFTER_DELETE = "afterDelete";

    const BEFORE_VIEW = "beforeView";
    const AFTER_VIEW = "afterView";

    const CALL_OWNER_EVENT = "callOwnerEvent";

    public $modelName;
    public $searchModelName;

    public function init()
    {
        parent::init();
        //绑定回调事件
        $owner = $this->owner;

    }



}
