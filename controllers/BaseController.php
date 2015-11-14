<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;
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
    public $modelFormClass;
    public $findModel;

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
     * 首页列表数据
     * @return [type] [description]
     */
    public function actionIndex()
    {
        $searchModel = Yii::createObject($this->modelFormClass);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
                                    'dataProvider'=>$dataProvider,
                                    'searchModel'=>$searchModel
                                    ]
                            );
    }

    /**
     * 创建数据
     * @return [type] [description]
     */
    public function actionCreate()
    {
        $model = new $this->modelClass([
            'scenario' => Model::SCENARIO_DEFAULT,
        ]);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ( $model->save() )
        {
           return $this->afterCreate( $model );
        }
        elseif (!$model->hasErrors())
        {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        $data = null;
        return $this->render('create',['model'=>$model]);
    }

    /**
     * 编辑页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionEdit( $id )
    {
        $model = $this->findModel($id);
        return $this->render('edit',['model'=>$model]);
    }

    /**
     * 查看详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionView( $id )
    {
        $userid = 0;
        if( !Yii::$app->user->isGuest )
        {
            $userid = Yii::$app->user->id;
        }
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model,'user_id'=>$userid]);
    }

    /**
     * 删除数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionDelete( $id )
    {
        $model = $this->findModel($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        return $this->afterDelete( $model );
    }

    /**
     * 更新数据
     * @return [type] [description]
     */
    public function actionUpdate( $id )
    {
        $model = $this->findModel($id);
        $model->scenario = Model::SCENARIO_DEFAULT;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        elseif($model->hasErrors())
        {
            return $this->render('view',['model'=>$model]);
        }
        return $this->afterUpdate( $model );
    }

    private function findModel($id)
    {
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

}
