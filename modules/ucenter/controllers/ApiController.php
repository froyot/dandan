<?php
namespace app\modules\ucenter\controllers;

use app\modules\ucenter\models\ApiUser;
use app\modules\ucenter\components\UC;
use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
    public $get;
    public function init() {//将接收过来的参数进行解密
        $this->get = $post = array();
        $code = http_build_query(Yii::$app->request->post()).'&agent='.md5($_SERVER['HTTP_USER_AGENT'])."&time=".time();
        $AuthCode = new UC();
        var_dump($AuthCode->authcode($code, 'DECODE', UC_KEY));die;
        parse_str($AuthCode->authcode($code, 'DECODE', UC_KEY), $this->get);
        if(empty($this->get)) {
            exit('Invalid Request');
        }
        if(time() - $this->get['time'] > 3600) {
            exit('Authracation has expiried');
        }
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
    }

    public function actionSynlogin() {//同步登录
        $uid = intval($this->get['uid']);
        $model = new \common\models\LoginForm();
        $model->loginByUid($uid);
    }

    public function actionSynlogout() {
        Yii::$app->user->logout();
    }

    public function actionIndex()
    {
        $method = isset($this->get['action']) ? $this->get['action'] : '';

        $model = new ApiUser();
        return $model->$method($this->get);
    }
}
