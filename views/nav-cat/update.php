<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\action\NavCat */

$this->title = 'Update Nav Cat: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nav Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->navcid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nav-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
