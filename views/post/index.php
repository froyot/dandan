<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\PostForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'listorder',
             'value'=>'postExtra.listorder',
             'label'=>Yii::t('app','order')
            ],
            'post_title:ntext',
            ['attribute'=>'cat_name',
             'value'=>'postExtra.term.name',
             'label'=>Yii::t('app','cat_name')
            ],
            'post_hits',
            'comment_count',
            'post_keywords',
            'post_source',
            'post_excerpt:ntext',
            'post_author',
            'post_date',
            'post_status',
            ['class' => 'yii\grid\ActionColumn',
             'template'=>" {update} | {delete}",
             'buttons'=>[
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
