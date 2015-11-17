<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\action\Nav */

$this->title = 'Update Nav: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Navs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nav-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option' =>['action'=>Url::to(['nav/update','id'=>$model->id])]
    ]) ?>

</div>
