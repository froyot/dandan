<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\NavCat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nav-cat-form">

    <?php $form = ActiveForm::begin($option); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'name'=>'name']) ?>

    <?= $form->field($model, 'active')->dropDownList([
                                                    1=>Yii::t('app','actived'),
                                                    0=>Yii::t('app','unactived')
                                                ],['name'=>'active']);?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6,'name'=>'remark']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
