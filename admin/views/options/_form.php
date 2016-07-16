<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model->isNewRecord):?>
    <?= $form->field($model, 'key')->textInput(['maxlength' => 255,'disabled'=>false]) ?>
    <?php else:?>
    <?= $form->field($model, 'key')->textInput(['maxlength' => 255,'disabled'=>true]) ?>
    <?php endif;?>
    <?= $form->field($model, 'des')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
