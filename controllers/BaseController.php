<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * @var string the model class name. This property must be set.
     */
    public $modelClass;
    /**
     * @var string the scenario used for updating a model.
     * @see \yii\base\Model::scenarios()
     */
    public $updateScenario = Model::SCENARIO_DEFAULT;

    /**
     * @var string the scenario used for creating a model.
     * @see \yii\base\Model::scenarios()
     */
    public $createScenario = Model::SCENARIO_DEFAULT;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->modelClass === null) {
            throw new InvalidConfigException('The "modelClass" property must be set.');
        }
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'app\controllers\actions\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'view' => [
                'class' => 'app\controllers\actions\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'edit' => [
                'class' => 'app\controllers\actions\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'create' => [
                'class' => 'app\controllers\actions\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
            'update' => [
                'class' => 'app\controllers\actions\UpdateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->updateScenario,
            ],
            'delete' => [
                'class' => 'app\controllers\actions\DeleteAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param object $model the model to be accessed. If null, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    public function checkAccess($action, $model = null, $params = [])
    {

    }

    public function afterAction($action, $result)
    {
        $renderFile = $action->id;
        if( $action->id == 'update' )
        {
            if( $result->hasErrors() )
            {
                $renderFile = 'edit';
            }
            else
            {
                return $this->redirect(['user/view','id'=>Yii::$app->request->get('id')]);
            }
        }
        $userid = 0;
        if( !Yii::$app->user->isGuest )
        {
            $userid = Yii::$app->user->id;
        }

        $result = $this->render($renderFile, ['data'=>$result,'user_id'=>$userid]);
        $result = parent::afterAction($action, $result);
        return $result;
    }
}
