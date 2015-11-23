<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */
/* @var $form yii\widgets\ActiveForm */
use allon\yii2\ueditor\Ueditor;
?>

<div class="content-form">

    <?php $form = ActiveForm::begin($option); ?>

    <?= $form->field($model, 'user_nicename')->textInput() ?>
    <?= $form->field($model, 'user_email')->textInput() ?>
    <?= $form->field($model, 'sex')->dropDownList([
                                                    0=>Yii::t('app','female'),
                                                    1=>Yii::t('app','male')
                                                ]);?>
    <?= $form->field($model, 'birthday')->textInput() ?>
    <?= $form->field($model, 'signature')->textInput() ?>
    <?= $form->field($model, 'mobile')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
