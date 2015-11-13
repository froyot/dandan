<?php

namespace app\controllers;
use yii\base\Model;
use Yii;


class NavController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\Nav";
    public $modelFormClass = "app\models\\form\NavForm";

    public function afterCreate( $model )
    {
        return $this->redirect(['index']);
    }

    public function afterUpdate( $model )
    {
        return $this->redirect(['index']);
    }

    public function afterDelete( $model )
    {
        return $this->redirect(['index']);
    }

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
        if( Yii::$app->getRequest()->getIsGet() )
        {
            $model->parentid = Yii::$app->getRequest()->get('parent');
        }
        return $this->render('create',['model'=>$model]);
    }

}
