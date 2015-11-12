<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

$this->title = Yii::t('app','edit userinfo');
?>
<div class="content-update">
    <?= $this->render('_form', [
        'model' => $data
    ]) ?>

</div>

