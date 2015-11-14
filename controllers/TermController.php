<?php

namespace app\controllers;

use Yii;
use yii\web\ServerErrorHttpException;
use yii\base\Model;
/**
 * TermController implements the CRUD actions for Term model.
 */
class TermController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\Term";
    public $modelFormClass = "app\models\\form\TermForm";

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
        if(Yii::$app->getRequest()->getIsGet())
        {
            if( Yii::$app->getRequest()->get('parent'))
                $model->parent = Yii::$app->getRequest()->get('parent');
        }
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
}
