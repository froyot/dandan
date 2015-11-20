<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\form\slideForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Slides');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-index">
    <?php  echo $this->render('/public/_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'slide_id',
            'slide_cid',
            'slide_name',
            [
            'attribute'=>'slide_pic',
            'format' => 'raw',
            'value'=>function($model){
                return "<img src='".$model->slide_pic."' style='max-height:4rem;max-width:10rem;'/>";
            }
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'template'=>" {update} | {delete}",
            'buttons'=>[
                'update'=>function($url, $model, $key){

                    return Html::a(Yii::t('yii', 'Update'), Url::to(['edit','id'=>$key]));
                }
            ]
            ],
        ],
    ]); ?>

</div>
