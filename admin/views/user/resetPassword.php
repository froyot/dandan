<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'reset {user_login} password', ['user_login' => $model->getUserLogin()]);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-form">
    <?php $form = ActiveForm::begin();?>
    <?php if ($model->userId == Yii::$app->user->id): ?>
        <?=$form->field($model, 'oldPassword')->passwordInput(['maxlength' => true])?>
    <?php endif;?>
    <?=$form->field($model, 'password')->passwordInput(['maxlength' => true])?>
    <?=$form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true])?>
    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'update'), ['class' => 'btn btn-success'])?>
    </div>
    <?php ActiveForm::end();?>
</div>
