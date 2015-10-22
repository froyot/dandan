<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\form\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_keyword',['template'=> "{input}\n{hint}\n{error}","inputOptions"=>["placeholder"=>Yii::t('app','search keyword')]]) ?>
    <div class="form-group">
        <?= Html::submitButton(\Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
