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
    <?= $form->field($model, 'slide_cid')->dropDownList($cid,['prompt' => 'select category'])?>
    <?= $form->field($model, 'slide_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slide_pic')->fileInput() ?>

    <?= $form->field($model, 'slide_type')->dropDownList(['page'=>'page','post'=>'post'],['prompt' => 'select type']);?>
    <?= $form->field($model, 'slide_value')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slide_des')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slide_status')->textInput() ?>

    <?= $form->field($model, 'listorder')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
