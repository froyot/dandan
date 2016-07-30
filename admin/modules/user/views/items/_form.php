<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Users admin\modules\user\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'create_at')->render(function($filed){

                return '<div class="has-feedback"><input type="text" class="form-control has-feedback-left datetimeinput"   aria-describedby="inputSuccesscreate_at" value="'.$filed->model->create_at.'">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccesscreate_at" class="sr-only">(success)</span></div>
                      ';
            }) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Not Used', 'Used', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
