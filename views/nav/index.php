<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\NavForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app','create').Yii::t('app','menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'listorder',
            'id',
            'label',
            [
                'attribute'=>'status',
                'value'=>function( $model )
                {
                    return $model->status? Yii::t('app','show'):Yii::t('app','hidden');
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
             'template'=>"{addSub} | {update} | {delete}",
             'buttons'=>[
                'addSub'=>function( $url,$model, $key )
                {
                    $options = [
                        'title' => Yii::t('app', 'add submenu'),
                        'aria-label' => Yii::t('app', 'add submenu'),
                        'data-pjax' => '0',
                    ];
                    return Html::a(Yii::t('app', 'add submenu'), Url::to(['create','parent'=>$key]), $options);
                },
                'update'=>function( $url, $model ,$key )
                {
                    $options = [
                        'title' => Yii::t('app', 'add submenu'),
                        'aria-label' => Yii::t('app', 'add submenu'),
                        'data-pjax' => '0',
                    ];
                    return Html::a(Yii::t('yii', 'Update'), Url::to(['edit','id'=>$key]), $options);
                }
             ]

            ],
        ],
    ]); ?>

</div>
