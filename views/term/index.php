<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\TermForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Term', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'term_id',
            'name',
            ['attribute'=>'taxonomy',
            'value'=>function($model){
                return Yii::t('app',$model->taxonomy);
            }
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'template'=> '{addSub} {update} {delete}',
            'buttons'=>[
                'addSub'=>function( $url,$model, $key )
                {
                    $options = [
                        'title' => Yii::t('app', 'add sub cat'),
                        'aria-label' => Yii::t('app', 'add sub cat'),
                        'data-pjax' => '0',
                    ];
                    return Html::a(Yii::t('app', 'add sub cat'), Url::to(['create','parent'=>$key]), $options);
                },
                'update'=>function( $url, $model ,$key )
                {
                    $options = [
                        'title' => Yii::t('yii', 'Update'),
                        'aria-label' => Yii::t('yii', 'Update'),
                        'data-pjax' => '0',
                    ];
                    return Html::a(Yii::t('yii', 'Update'), Url::to(['edit','id'=>$key]), $options);
                }
            ]
            ],
        ],
    ]); ?>

</div>
