<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\action\SlideCat;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\action\slide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin($option); ?>
    <?php
        $cid  =SlideCat::find()->asArray()->all();
        if($cid)
        {
            $cid = ArrayHelper::map($cid, 'cid', 'cat_name');
        }
        else
        {
            $cid = [];
        }
    ?>
    <?= $form->field($model, 'slide_cid')->dropDownList($cid,['prompt' => 'select category','name'=>'slide_cid'])?>
    <?= $form->field($model, 'slide_name')->textInput(['maxlength' => true,'name'=>'slide_name']) ?>
    <?= $form->field($model, 'slide_pic')->fileInput(['name'=>'slide_pic']) ?>

    <?= $form->field($model, 'slide_type')->dropDownList(['page'=>'page','post'=>'post'],['prompt' => 'select type','name'=>'slide_type']);?>
    <?= $form->field($model, 'slide_value')->textInput(['maxlength' => true,'name'=>'slide_value']) ?>
    <?= $form->field($model, 'slide_des')->textInput(['maxlength' => true,'name'=>'slide_des']) ?>
    <?= $form->field($model, 'slide_status')->textInput(['name'=>'slide_status']) ?>

    <?= $form->field($model, 'listorder')->textInput(['name'=>'listorder']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
