<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

?>
<div class="site-login">
    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
    'id' => 'input-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);?>

    <?=$form->field($model, 'dbhost')?>
    <?=$form->field($model, 'dbport')?>
    <?=$form->field($model, 'dbname')?>
    <?=$form->field($model, 'db_password')?>
    <?=$form->field($model, 'db_user_name')?>
    <?=$form->field($model, 'db_prefix')?>

    <?=$form->field($model, 'site_name')?>
    <?=$form->field($model, 'site_seo_keywords')?>
    <?=$form->field($model, 'site_seo_description')?>

    <?=$form->field($model, 'admin')?>
    <?=$form->field($model, 'password')->passwordInput()?>
    <?=$form->field($model, 'repeatPassword')->passwordInput()?>
    <?=$form->field($model, 'email')?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?=Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button'])?>

        </div>
    </div>

    <?php ActiveForm::end();?>
</div>
