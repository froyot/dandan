<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'create friendLink');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'friendLink'), 'url' => ['links']];
$this->params['breadcrumbs'][] = $this->title;
?>





<div>
    <?php $form = ActiveForm::begin();?>
    <?=$form->field($model, 'site_name')->textInput(['maxlength' => true, 'name' => 'site_name'])?>
    <?=$form->field($model, 'site_url')->textInput(['name' => 'site_url'])?>
    <?=$form->field($model, 'open_type')->dropDownList(['default' => Yii::t('app', 'default'), '_blank' => Yii::t('app', 'new window')], ['name' => 'open_type'])?>
    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary'])?>
    </div>
 <?php ActiveForm::end();?>
</div>
