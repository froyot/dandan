<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\models\Options */

$this->title = 'Create Options';
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel">
  <div class="x_title">
    <h2><?= Html::encode($this->title) ?></h2>

    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 </div>

</div>
