<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\ParamsForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','nav cat');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="params-index">

    <p>
        <?= Html::a(Yii::t('app','create').Yii::t('app','nav cat'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="nav-cat-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <?= $form->field($searchModel, '_keywords')->textInput(['name'=>'_keywords']) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'navcid',
            'name',
            [
            'attribute'=>'active',
            'value'=>function($model){
                return $model->active?Yii::t('app','actived'):Yii::t('app','unactived');
            }
            ],
            'remark',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'update' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Update'),
                                'aria-label' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['edit','id'=>$key]), $options);
                    }
                ],
            ]
        ],
    ]); ?>

</div>
