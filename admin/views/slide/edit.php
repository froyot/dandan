<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\action\slide */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Slide',
]) . ' ' . $model->slide_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->slide_id, 'url' => ['view', 'id' => $model->slide_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="slide-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option'=>['action'=>['slide/update','id'=>$model->id],
                   'option'=>['enctype' => 'multipart/form-data']]
    ]) ?>

</div>
