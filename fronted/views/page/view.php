<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'post_author',
            'post_keywords',
            'post_source',
            'post_date',
            'post_content:ntext',
            'post_title:ntext',
            'post_excerpt:ntext',
            'post_status',
            'comment_status',
            'post_modified',
            'post_content_filtered:ntext',
            'post_parent',
            'post_type',
            'post_mime_type',
            'comment_count',
            'smeta:ntext',
            'post_hits',
            'post_like',
            'istop',
            'recommended',
        ],
    ]) ?>

</div>
