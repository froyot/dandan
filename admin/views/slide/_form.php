<?php

use app\models\action\SlideCat;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\slide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin($option);?>
    <?php
$cid = SlideCat::find()->asArray()->all();
if ($cid) {
    $cid = ArrayHelper::map($cid, 'cid', 'cat_name');
} else {
    $cid = [];
}
?>
    <?=$form->field($model, 'slide_cid')->dropDownList($cid, ['prompt' => Yii::t('app', 'select') . Yii::t('app', 'category')])?>
    <?=$form->field($model, 'slide_name')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'slide_pic')->fileInput()?>

    <?=$form->field($model, 'slide_type')->dropDownList(['page' => Yii::t('app', 'page'), 'post' => Yii::t('app', 'post')], ['prompt' => Yii::t('app', 'select') . Yii::t('app', 'type')]);?>
    <?=$form->field($model, 'slide_value')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'slide_des')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'listorder')->textInput()?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
