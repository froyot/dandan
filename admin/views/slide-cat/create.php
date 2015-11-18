<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\action\slideCat */

$this->title = Yii::t('app', 'Create Slide Cat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slide Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-cat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option'=>['enctype' => 'multipart/form-data']
    ]) ?>

</div>
