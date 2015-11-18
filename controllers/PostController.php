<?php

namespace app\controllers;

use Yii;
use app\models\action\Post;
use app\models\form\PostForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\action\Term;
use app\models\action\Comment;
use yii\widgets\ActiveForm;
use yii\web\Response;

class PostController  extends Controller
{
    public $requestData = [];

    //列表显示
    public function actionIndex()
    {

        $this->requestData = ArrayHelper::merge(
                Yii::$app->request->queryParams,
                ['post_type'=>'post']
            );

        list($searchModel, $dataProvider) = $this->getData();
        $breadcrum = \Yii::t('app','post list');
        return $this->render('index',[
                                    'dataProvider'=>$dataProvider,
                                    'searchModel'=>$searchModel,
                                    'breadcrum'=>$breadcrum
                                    ]
                            );
    }

    private function getData( )
    {
        $searchModel = new PostForm();
        $dataProvider = $searchModel->search(
            $this->requestData
        );
        return [$searchModel, $dataProvider];
    }

    //查看详情
    public function actionView()
    {
        $post = Post::find()->where([Post::tableName().'.id'=>Yii::$app->request->get('id')])
                ->joinWith('postExtra')
                ->joinWith('postExtra.term')
                ->joinWith('author')
                ->one();
        if( $post )
        {
            if( $post->post_type == 'post' )
            {
                $view = 'view';
            }
            elseif( $post->post_type == 'page' )
            {
                $view = 'page';
            }
            return $this->render($view,['post'=>$post]);
        }
    }

    //查看分类下的文章
    public function actionCat()
    {
        $this->requestData = ArrayHelper::merge(
                Yii::$app->request->queryParams,
                ['sort'=>'-post_date']
            );

        $id = Yii::$app->request->get('id');
        $breadcrum = Yii::t('app','category')."%s".Yii::t('app','post list');
        $addParams = [
            'post_type'=>'post',
            'id'=>null,//过滤查询条件
        ];
        if( $id )
        {
            $category = Term::getCategory( $id );
            if( $category )
            {
               $addParams['cat_id'] = $category->term_id;
               $breadcrum = sprintf($breadcrum,$category->name);
            }
            else
            {
                $breadcrum = Yii::t('app','all').$breadcrum;
            }
        }
        else
        {
            $category = null;
            $breadcrum = Yii::t('app','all').$breadcrum;
        }
        list($searchModel, $dataProvider) = $this->getData();
        return $this->render('index',[
                                    'dataProvider'=>$dataProvider,
                                    'searchModel'=>$searchModel,
                                    'breadcrum'=>$breadcrum
                                    ]
                            );
    }

    //添加评论
    public function actionAddComment()
    {
        if(Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Comment();
            $model->post_table = 'posts';
            var_dump(Yii::$app->request->post());
            $model->load(Yii::$app->request->post(),'');
            if( Yii::$app->user->isGuest )
            {
                $model->scenario = 'guest';
            }
            else
            {
                $model->scenario = 'user';
                $model->uid = Yii::$app->user->id;
            }
            if( $model->validate() && $model->save() )
            {
                return ['status'=>true];
            }
            else
            {

                return ['status'=>false,'errors'=>$model->errors];
            }
        }
    }

}
