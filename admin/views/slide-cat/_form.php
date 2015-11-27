<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\slideCat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slide-cat-form">

    <?php $form = ActiveForm::begin($option);?>

    <?=$form->field($model, 'cat_name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'cat_idname')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'cat_remark')->textarea(['rows' => 6])?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
