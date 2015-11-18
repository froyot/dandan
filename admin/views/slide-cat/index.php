<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\slideCatForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Slide Cats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-cat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('/public/_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cid',
            'cat_name',
            'cat_idname',
            'cat_remark:ntext',
            'cat_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
