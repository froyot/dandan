<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

$this->title = 'Update Content: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content-update">
    <?= $this->render('_form', [
        'model' => $model,
        'categorys' => $categorys
    ]) ?>

</div>
