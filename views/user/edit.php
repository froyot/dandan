<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

$this->title = Yii::t('app','edit userinfo');
?>
<div class="content-update">
    <?= $this->render('_form', [
        'model' => $model,
        'option'=>['action'=>Url::to(['user/update','id'=>$model->id])]
    ]) ?>

</div>

