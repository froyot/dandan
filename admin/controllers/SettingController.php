<?php

namespace app\admin\controllers;

use Yii;
use app\models\action\Option;
use app\models\util\SiteOption;
use app\models\util\LinkOption;
class SettingController extends BaseController
{
    public $modelClass = '';
    public $modelFormClass = '';
    public $findModel = '';
    /**
     * 网站设置
     * @return [type] [description]
     */
    public function actionSite()
    {
        $model = new SiteOption();
        if( Yii::$app->getRequest()->getIsPost() )
        {
            $model->load( Yii::$app->getRequest()->post(), '' );
            $res = $model->save();
        }
        else
        {
            $data = Option::getSiteOption();
            if( $data !== null )
                $model->load( $data, '');
            else
                return '';
        }
        return $this->render('site',['model'=>$model]);
    }

    public function actionLinks()
    {
        $modes = LinkOption::getAllLinks();
        return $this->render('friendLinks',['modes'=>$modes]);
    }

    public function actionCreateLink()
    {
        $model = new LinkOption();
        if( Yii::$app->getRequest()->getIsPost() )
        {
            $model->load(Yii::$app->getRequest()->post(),'');
            if( $model->save() )
            {
                return $this->redirect(['links']);
            }
        }
        return $this->render('create-link',['model'=>$model]);
    }

    public function actionDeleteLink()
    {
        $key = Yii::$app->getRequest()->get('key');
        $model = new LinkOption();
        if( $model->delete($key) )
        {
            return $this->redirect(['links']);
        }
    }

}
