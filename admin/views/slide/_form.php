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
    <?=$form->field($model, 'slide_cid')->dropDownList($cid, ['prompt' => Yii::t('app', 'select') . Yii::t('app', 'category'), 'name' => 'slide_cid'])?>
    <?=$form->field($model, 'slide_name')->textInput(['maxlength' => true, 'name' => 'slide_name'])?>
    <?=$form->field($model, 'slide_pic')->fileInput(['name' => 'slide_pic'])?>

    <?=$form->field($model, 'slide_type')->dropDownList(['page' => Yii::t('app', 'page'), 'post' => Yii::t('app', 'post')], ['prompt' => Yii::t('app', 'select') . Yii::t('app', 'type'), 'name' => 'slide_type']);?>
    <?=$form->field($model, 'slide_value')->textInput(['maxlength' => true, 'name' => 'slide_value'])?>
    <?=$form->field($model, 'slide_des')->textInput(['maxlength' => true, 'name' => 'slide_des'])?>

    <?=$form->field($model, 'listorder')->textInput(['name' => 'listorder'])?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
