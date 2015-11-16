<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'post_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_date')->textInput() ?>

    <?= $form->field($model, 'post_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_excerpt')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_status')->textInput() ?>

    <?= $form->field($model, 'comment_status')->textInput() ?>

    <?= $form->field($model, 'post_modified')->textInput() ?>

    <?= $form->field($model, 'post_content_filtered')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_type')->textInput() ?>

    <?= $form->field($model, 'post_mime_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smeta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_hits')->textInput() ?>

    <?= $form->field($model, 'post_like')->textInput() ?>

    <?= $form->field($model, 'istop')->textInput() ?>

    <?= $form->field($model, 'recommended')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
