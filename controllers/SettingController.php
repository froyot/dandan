<?php

namespace app\admin\controllers;

use Yii;
use app\models\action\Option;
use app\models\util\SiteOption;

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
}
