<?php

namespace admin\controllers;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\db\Schema;
use yii\gii\CodeFile;
use yii\helpers\Inflector;
use yii\base\NotSupportedException;
/**
 * 模块自动构建
 * 根据输入的表名称，自动根据模板构建模块
 */



use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use admin\models\Generator;
use yii\web\NotFoundHttpException;

class GenerateController extends Controller
{
    public $enableCsrfValidation = false;
    public $_left_nav = ['Setting','generate/index'];
    /**
     * 登陆验证
     * @return [type] [description]
     */
    public function behaviors()
    {
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


    /**
     * 自动构建首页，显示自动构建表单
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2016-07-27T16:57:15+0800
     * @return   [type]                   [description]
     */
    public function actionIndex()
    {
        $generator = new Generator();
        $params=['generator'=>$generator];//
        if(Yii::$app->request->isPost)
        {

                $generator->load(Yii::$app->request->post());

                if ($generator->validate()) {
                    $generator->saveStickyAttributes();
                    $files = $generator->generate();
                    if (isset($_POST['generate']) && !empty($_POST['answers'])) {
                        $params['hasError'] = !$generator->save($files, (array) $_POST['answers'], $results);
                        $params['results'] = $results;
                    } else {
                        $params['files'] = $files;
                        $params['answers'] = isset($_POST['answers']) ? $_POST['answers'] : null;
                    }
                }

        }
        return $this->render('index',$params);
    }

    public function actionPreview($id, $file)
    {
        $generator = new Generator();
        $generator->load(Yii::$app->request->post());
        if ($generator->validate()) {
            foreach ($generator->generate() as $f) {
                if ($f->id === $file) {
                    $content = $f->preview();
                    if ($content !== false) {
                        return  '<div class="content">' . $content . '</content>';
                    } else {
                        return '<div class="error">Preview is not available for this file type.</div>';
                    }
                }
            }
        }

        throw new NotFoundHttpException("Code file not found: $file");
    }

    public function actionDiff($id, $file)
    {
        $generator = new Generator();
        $generator->load(Yii::$app->request->post());
        if ($generator->validate()) {
            foreach ($generator->generate() as $f) {
                if ($f->id === $file) {
                    return $this->renderPartial('@yii/gii/views/default/diff', [
                        'diff' => $f->diff(),
                    ]);
                }
            }
        }
        throw new NotFoundHttpException("Code file not found: $file");
    }





}
