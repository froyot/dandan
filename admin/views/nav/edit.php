<?php

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\action\Nav */

$this->title = Yii::t('app', 'update') . Yii::t('app', 'menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="nav-update">
    <?=$this->render('_form', [
'model' => $model,
'option' => ['action' => Url::to(['nav/update', 'id' => $model->id])],
])?>

</div>
