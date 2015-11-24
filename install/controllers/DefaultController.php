<?php

namespace app\install\controllers;
use app\install\models\InstallForm;
use app\install\models\Tool;
use app\models\util\CacheManage;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller {
    public $layout = 'install';
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCheck() {
        $server = Tool::checkEnvironment();
        $floder = [
            'install',
            'runtime',
            'web/assert',
        ];
        return $this->render('check', ['server' => $server, 'folder' => $floder]);
    }

    public function actionInstallData() {
        CacheManage::deleteAll();
        $model = new InstallForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && $model->save()) {
                Tool::makeInstallLock();
                return $this->redirect(['/fronted/site/index']);
            }
        }
        return $this->render('install-form', ['model' => $model]);
    }

}
