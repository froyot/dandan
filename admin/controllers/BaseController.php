<?php

namespace app\admin\controllers;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;

class BaseController extends Controller {

    /**
     * 模板设定
     * @var string
     */
    public $layout = 'main';
    /**
     * @var string the model class name. This property must be set.
     */

    /**
     * 当前操作类
     * @var [type]
     */
    public $modelClass;

    /**
     * 当前搜索类
     * @var [type]
     */
    public $modelFormClass;

    /**
     * 获取的对象
     * @var [type]
     */
    public $findModel;

    /**
     * 额外搜索添加
     * @var array
     */
    protected $addParams = [];
    /**
     * 插入场景
     * @var [type]
     */
    public static $SCENARIO_INSERT = Model::SCENARIO_DEFAULT;

    /**
     * 数据更新场景
     * @var [type]
     */
    public static $SCENARIO_UPDATE = Model::SCENARIO_DEFAULT;

    /**
     * 登陆验证
     * @return [type] [description]
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => false,
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
    public function beforeAction($action) {

        if (parent::beforeAction($action)) {

            if (Yii::$app->user->isGuest) {
                return $this->redirect(['login']);exit;
            }

            $permission = $action->id . ' ' . $this->id;
            if (\Yii::$app->user->can($permission)) {
                return true;
            } else {
                throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
            }
        }
    }
    /**
     * 验证modelClass,FormClass是否设置
     */
    public function init() {
        parent::init();
        if ($this->modelFormClass === null) {
            throw new InvalidConfigException('The "modelFormClass" property must be set.');
        }
        if ($this->modelClass === null) {
            throw new InvalidConfigException('The "modelClass" property must be set.');
        }
    }

    /**
     * 首页列表数据
     * @return [type] [description]
     */
    public function actionIndex() {
        $searchModel = Yii::createObject($this->modelFormClass);
        $dataProvider = $searchModel->search(
            ArrayHelper::merge(Yii::$app->request->queryParams, $this->addParams));
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]
        );
    }

    /**
     * 创建数据
     * @return [type] [description]
     */
    public function actionCreate() {
        $model = new $this->modelClass([
            'scenario' => static::$SCENARIO_INSERT,
        ]);

        if (Yii::$app->getRequest()->getIsPost()) {
            $res = $model->load(Yii::$app->getRequest()->post());

            if ($model->save()) {
                return $this->afterCreate($model);
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            }

        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * 编辑页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionEdit($id) {
        $model = $this->findModel($id);
        $this->beforeRenderEdit($model);
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 查看详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionView($id) {
        $userid = 0;
        if (!Yii::$app->user->isGuest) {
            $userid = Yii::$app->user->id;
        }
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model, 'user_id' => $userid]);
    }

    /**
     * 删除数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        return $this->afterDelete($model);
    }

    /**
     * 更新数据
     * @return [type] [description]
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {

            $model = $this->findModel($id);
            $model->scenario = static::$SCENARIO_UPDATE;
            $model->load(Yii::$app->getRequest()->getBodyParams());
            // var_dump($model->toArray());die;
            if ($model->save() === false && !$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
            } elseif (!$model->hasErrors()) {
                return $this->afterUpdate($model);

            }

        }
        $userid = 0;
        if (!Yii::$app->user->isGuest) {
            $userid = Yii::$app->user->id;
        }
        $this->beforeRenderEdit($model);
        return $this->render('edit', ['model' => $model]);

    }

    /**
     * 根据主键获取模型
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    private function findModel($id) {
        if ($this->findModel !== null) {
            return call_user_func($this->findModel, $id, $this);
        }

        /* @var $modelClass ActiveRecordInterface */
        $modelClass = $this->modelClass;
        $keys = $modelClass::primaryKey();
        if (count($keys) > 1) {
            $values = explode(',', $id);
            if (count($keys) === count($values)) {
                $model = $modelClass::findOne(array_combine($keys, $values));
            }
        } elseif ($id !== null) {
            $model = $modelClass::findOne($id);
        }

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    /**
     * @inheritdoc
     */
    protected function verbs() {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

}
