<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'site_name')->textInput(['maxlength' => true,'name'=>'site_name']) ?>
    <?= $form->field($model, 'site_host')->textInput(['maxlength' => true,'name'=>'site_host']) ?>
    <?= $form->field($model, 'site_root')->textInput(['maxlength' => true,'name'=>'site_root']) ?>
    <?= $form->field($model, 'site_icp')->textInput(['name'=>'site_icp']) ?>
    <?= $form->field($model, 'site_admin_email')->textInput(['rows' => 6,'name'=>'site_admin_email']) ?>
    <?= $form->field($model, 'site_seo_title')->textInput(['name'=>'site_seo_title']) ?>
    <?= $form->field($model, 'site_seo_keywords')->textInput(['name'=>'site_seo_keywords']) ?>
    <?= $form->field($model, 'site_tongji')->textarea(['rows' => 6,'name'=>'site_tongji']) ?>
    <?= $form->field($model, 'site_seo_description')->textarea(['rows' => 6,'name'=>'site_seo_description']) ?>
    <?= $form->field($model, 'comment_need_check')->checkbox(['name'=>'comment_need_check']) ?>
    <?= $form->field($model, 'comment_time_interval')->textInput(['name'=>'comment_time_interval']) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


