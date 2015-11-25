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

    /**
     * 缓存配置
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-25T16:42:30+0800
     * @return   [type]                   [description]
     */
    public function actionConfig() {
        CacheManage::deleteAll();
        $model = new InstallForm();
        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->isPost && $model->validate() && $model->writeDatabseConfig()) {
            Yii::$app->cache->set('tmpConfig', serialize(Yii::$app->request->post()));
            return $this->redirect(['install-data']);
        }
        return $this->render('install-form', ['model' => $model]);
    }

    //导入数据库
    public function actionInstallData() {

        if (Yii::$app->request->isPost) {
            $id = intval(Yii::$app->request->post('id'));
            $data = unserialize(Yii::$app->cache->get('tmpConfig'));
            $model = new InstallForm();
            $model->load($data);
            $res = $model->installData($id);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($res) {
                return [
                    'status' => true,
                    'next' => $res[0],
                    'msg' => $res[1],
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => $model->errors,
                ];
            }
        } else {
            return $this->render('install-data');
        }
    }

    public function actionInstallConfig() {
        if (Yii::$app->request->isPost) {
            $data = unserialize(Yii::$app->cache->get('tmpConfig'));
            $model = new InstallForm();
            $model->load($data);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->save()) {
                return [
                    'status' => true,

                ];
            }
        }
    }

}
