<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace easydandan\actions;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAction extends Action
{
    /**
     * @var callable a PHP callable that will be called to prepare a data provider that
     * should return a collection of the models. If not set, [[prepareDataProvider()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($action) {
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return an instance of [[ActiveDataProvider]].
     */
    public $prepareDataProvider;


    /**
     * @return ActiveDataProvider
     */
    public function run()
    {

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $data = $this->prepareDataProvider();
        return $this->controller->render('index',['dataProvider'=>$data]);

    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;


        return new ActiveDataProvider([
            'query' => $modelClass::find(),
        ]);
    }


}
