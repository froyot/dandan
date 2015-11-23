<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\util\ViewHelper;
/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'siteSetting');

$this->params['breadcrumbs'][] = $this->title;
?>


<ul id="myTab" class="nav nav-tabs">
   <li class="active">
      <a href="#home" data-toggle="tab">
        <?=Yii::t('app','basic setting');?>
      </a>
   </li>
   <li><a href="#seo" data-toggle="tab"><?=Yii::t('app','seo setting');?></a></li>
   <li><a href="#comment" data-toggle="tab"><?=Yii::t('app','comment setting');?></a></li>
   <li><a href="#smtp" data-toggle="tab"><?=Yii::t('app','smtp setting');?></a></li>

</ul>

 <?php $form = ActiveForm::begin(); ?>
<div id="myTabContent" class="tab-content">

    <div class="tab-pane fade in active" id="home">
        <?= $form->field($model, 'site_name')->textInput(['maxlength' => true,'name'=>'site_name']) ?>
        <?= $form->field($model, 'site_icp')->textInput(['name'=>'site_icp']) ?>
        <?= $form->field($model, 'site_admin_email')->textInput(['rows' => 6,'name'=>'site_admin_email']) ?>
        <?= $form->field($model, 'site_themes')->dropDownList(ViewHelper::getThemeList(),['name'=>'site_themes']) ?>
    </div>

    <div class="tab-pane fade" id="seo">
        <?= $form->field($model, 'site_seo_title')->textInput(['name'=>'site_seo_title']) ?>
        <?= $form->field($model, 'site_seo_keywords')->textInput(['name'=>'site_seo_keywords']) ?>
        <?= $form->field($model, 'site_tongji')->textarea(['rows' => 6,'name'=>'site_tongji']) ?>
        <?= $form->field($model, 'site_seo_description')->textarea(['rows' => 6,'name'=>'site_seo_description']) ?>
    </div>

    <div class="tab-pane fade" id="comment">
        <?= $form->field($model, 'comment_need_check')->checkbox(['name'=>'comment_need_check']) ?>
        <?= $form->field($model, 'comment_time_interval')->textInput(['name'=>'comment_time_interval']) ?>
        <?= $form->field($model, 'comment_type')->dropDownList([
                                                    0=>Yii::t('app','site comment'),
                                                    1=>Yii::t('app','shoucs comment'),
                                                    ]
                                                    ,['name'=>'comment_type']) ?>
        <?= $form->field($model, 'comment_appid')->textInput(['name'=>'comment_appid']) ?>
        <?= $form->field($model, 'comment_appkey')->textInput(['name'=>'comment_appkey']) ?>
    </div>
    <div class="tab-pane fade" id="smtp">
    <?= $form->field($model, 'smtp_host')->textInput(['name'=>'smtp_host']) ?>
    <?= $form->field($model, 'smtp_username')->textInput(['name'=>'smtp_username']) ?>
    <?= $form->field($model, 'smtp_password')->textInput(['name'=>'smtp_password']) ?>
    <?= $form->field($model, 'smtp_port')->textInput(['name'=>'smtp_port']) ?>
    <?= $form->field($model, 'smtp_label')->textInput(['name'=>'smtp_label']) ?>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class'=>'btn btn-primary']) ?>
    </div>
 <?php ActiveForm::end(); ?>

