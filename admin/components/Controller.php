<?php
namespace admin\components;

use Yii;
use yii\easyii\models;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Base easyii controller component
 * @package yii\easyii\components
 */
class Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $rootActions = [];
    public $error = null;
    public $_left_nav = ['Home','site/index'];
    public $modelClass;
    public $modelSearch;


    /**
     * Check authentication, and root rights for actions
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     * @throws \yii\web\ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action))
            return false;

        // if(Yii::$app->user->isGuest){
        //     Yii::$app->user->setReturnUrl(Yii::$app->request->url);
        //     Yii::$app->getResponse()->redirect(['/admin/sign/in'])->send();
        //     return false;
        // }
        // else{
        //     if(!IS_ROOT && ($this->rootActions == 'all' || in_array($action->id, $this->rootActions))){
        //         throw new \yii\web\ForbiddenHttpException('You cannot access this action');
        //     }

            if($action->id === 'index'){
                $this->setReturnUrl();
            }

            return true;
        // }
    }

    protected function pageList()
    {
        $modelSearch = Yii::createObject(
            [
                'class'=>$this->modelSearch
            ]
        );

        return $modelSearch->search(Yii::$app->request->get());
    }

    public function actionCreate()
    {
        $model = Yii::createObject(
            [
                'class'=>$this->modelClass
            ]
        );

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if( $model->validate() && $model->save() )
            {
                return $this->redirect($this->getReturnUrl());
            }
            else
            {
                var_dump($model->errors);die;
            }
        }
        return $this->render('create',['model'=>$model]);
    }

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if( $model->validate() && $model->save() )
            {
                return $this->redirect($this->getReturnUrl());
            }
        }
        return $this->render('update',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete())
        {
            return $this->redirect($this->getReturnUrl());
        }

    }
    /**
     * 修改状态
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-07-16T10:40:31+0800
     * @return   [type]                   [description]
     */
    public function actionSetStatus($id)
    {
        $model = $this->findModel($id);
        if( $model->changeStatus() )
        {
            return ['status'=>$model->status];
        }
        return false;
    }

    protected function findModel($primary)
    {
        $modelClass = Yii::createObject(
            [
                'class'=>$this->modelClass
            ]
        );
        $model = $modelClass->findOne($primary);

        if($model)
        {
            return $model;
        }
        throw new NotFoundHttpException();
    }


    /**
     * Write in sessions alert messages
     * @param string $type error or success
     * @param string $message alert body
     */
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type=='error'?'danger':$type, $message);
    }

    public function back()
    {
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Set return url for module in sessions
     * @param mixed $url if not set, returnUrl will be current page
     */
    public function setReturnUrl($url = null)
    {
        Yii::$app->getSession()->set($this->module->id.'_return', $url ? Url::to($url) : Url::current());
    }

    /**
     * Get return url for module from session
     * @param mixed $defaultUrl if return url not found in sessions
     * @return mixed
     */
    public function getReturnUrl($defaultUrl = null)
    {
        return Yii::$app->getSession()->get($this->module->id.'_return', $defaultUrl ? Url::to($defaultUrl) : Url::to('/admin/'.$this->module->id));
    }

    public function afterAction($action,$res)
    {
        if(Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if(is_bool($res) && !$res)
            {
                $res = ['status' => 'false'];
            }
            else
            {
                $res = ['status' => 'true','data'=>$res];
            }
        }
        return parent::afterAction($action,$res);
    }

    /**
     * Formats response depending on request type (ajax or not)
     * @param string $success
     * @param bool $back go back or refresh
     * @return mixed $result array if request is ajax.
     */
    public function formatResponse($success = '', $back = true)
    {
    //     if(Yii::$app->request->isAjax){
    //         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //         if($this->error){
    //             return ['result' => 'error', 'error' => $this->error];
    //         } else {
    //             $response = ['result' => 'success'];
    //             if($success) {
    //                 if(is_array($success)){
    //                     $response = array_merge(['result' => 'success'], $success);
    //                 } else {
    //                     $response = array_merge(['result' => 'success'], ['message' => $success]);
    //                 }
    //             }
    //             return $response;
    //         }
    //     }
    //     else{
    //         if($this->error){
    //             $this->flash('error', $this->error);
    //         } else {
    //             if(is_array($success) && isset($success['message'])){
    //                 $this->flash('success', $success['message']);
    //             }
    //             elseif(is_string($success)){
    //                 $this->flash('success', $success);
    //             }
    //         }
    //         return $back ? $this->back() : $this->refresh();
    //     }
    }
}
