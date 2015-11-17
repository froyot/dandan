<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\action\Nav */

$this->title = Yii::t('app','create').Yii::t('app','menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-create">
    <?= $this->render('_form', [
        'model' => $model,
        'option' =>[]
    ]) ?>

</div>
