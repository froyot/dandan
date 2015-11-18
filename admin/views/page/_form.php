<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\util\Tree;
/* @var $this yii\web\View */
/* @var $model app\models\action\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin($option); ?>


    <?= $form->field($model, 'post_title')->textInput(['maxlength' => true,'name'=>'post_title']) ?>
    <?= $form->field($model, 'post_keywords')->textInput(['maxlength' => true,'name'=>'post_keywords']) ?>
    <?= $form->field($model, 'post_source')->textInput(['maxlength' => true,'name'=>'post_source']) ?>
    <?= $form->field($model, 'post_excerpt')->textarea(['rows' => 6,'name'=>'post_excerpt']) ?>
    <?= $form->field($model, 'post_content')->textarea(['rows' => 6,'name'=>'post_content']) ?>
    <?= $form->field($model, 'post_status')->radioList([
                                                0=>Yii::t('app','post pass'),
                                                1=>Yii::t('app','wait view')
                                            ],['name'=>'post_status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
