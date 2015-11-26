<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'user_login')->textInput(['maxlength' => true])?>
    <?php if ($model->isNewRecord): ?>
    <?=$form->field($model, 'password')->textInput(['maxlength' => true])?>
    <?php endif;?>
    <?=$form->field($model, 'user_nicename')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'user_email')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'role')->DropDownList(ArrayHelper::map(Yii::$app->authManager->getAllRoles(), 'name', 'name'))?>
    <?=$form->field($model, 'sex')->DropDownList([0 => '女', 1 => '男'])?>
    <?=$form->field($model, 'birthday')->textInput()?>
    <?=$form->field($model, 'mobile')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
