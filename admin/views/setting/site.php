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
    <?= $form->field($model, 'site_icp')->textInput(['name'=>'site_icp']) ?>
    <?= $form->field($model, 'site_admin_email')->textInput(['rows' => 6,'name'=>'site_admin_email']) ?>
    <?= $form->field($model, 'site_seo_title')->textInput(['name'=>'site_seo_title']) ?>
    <?= $form->field($model, 'site_seo_keywords')->textInput(['name'=>'site_seo_keywords']) ?>
    <?= $form->field($model, 'site_tongji')->textarea(['rows' => 6,'name'=>'site_tongji']) ?>
    <?= $form->field($model, 'site_seo_description')->textarea(['rows' => 6,'name'=>'site_seo_description']) ?>
    <?= $form->field($model, 'comment_need_check')->checkbox(['name'=>'comment_need_check']) ?>
    <?= $form->field($model, 'comment_time_interval')->textInput(['name'=>'comment_time_interval']) ?>
    <?= $form->field($model, 'comment_type')->dropDownList([
                                                0=>Yii::t('app','site comment'),
                                                1=>Yii::t('app','shoucs comment'),
                                                ]
                                                ,['name'=>'comment_type']) ?>
    <?= $form->field($model, 'comment_appid')->textInput(['name'=>'comment_appid']) ?>
    <?= $form->field($model, 'comment_appkey')->textInput(['name'=>'comment_appkey']) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


