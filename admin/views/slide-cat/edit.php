<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\action\slideCat */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Slide Cat',
]) . ' ' . $model->cid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slide Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cid, 'url' => ['view', 'id' => $model->cid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="slide-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option'=>['action'=>['update','id'=>$model->id],
                    'enctype' => 'multipart/form-data']
    ]) ?>

</div>
