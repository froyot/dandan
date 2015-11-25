<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

?>

<div class="install-default-index">
<div class="header">
    <h1 class="logo">DanDan Cms</h1>
    <div class="icon_install">安装向导</div>
    <div class="version"></div>
</div>
<section class="section">
    <div class="step">
      <ul>
        <li><em>1</em>检测环境</li>
        <li class="current"><em>2</em>创建数据</li>
        <li><em>3</em>完成安装</li>
      </ul>
    </div>
<div class="install-form">


    <?php $form = ActiveForm::begin([
    'id' => 'input-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-sm-6\">{input}</div>\n<div class=\"col-sm-2\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);?>

    <div class="panel panel-default">
       <div class="panel-heading">
          <h3 class="panel-title">
             <?=Yii::t('app', 'database setting');?>
          </h3>
       </div>
       <div class="panel-body">
        <?=$form->field($model, 'dbhost')?>
        <?=$form->field($model, 'dbport')?>
        <?=$form->field($model, 'dbname')?>
        <?=$form->field($model, 'db_password')?>
        <?=$form->field($model, 'db_user_name')?>
        <?=$form->field($model, 'db_prefix')?>
       </div>
    </div>

    <div class="panel panel-default">
       <div class="panel-heading">
          <h3 class="panel-title">
             <?=Yii::t('app', 'siteSetting');?>
          </h3>
       </div>
       <div class="panel-body">
            <?=$form->field($model, 'site_name')?>
            <?=$form->field($model, 'site_seo_keywords')?>
            <?=$form->field($model, 'site_seo_description')?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
             <?=Yii::t('app', 'admin setting');?>
          </h3>
       </div>
       <div class="panel-body">
            <?=$form->field($model, 'admin')?>
            <?=$form->field($model, 'password')->passwordInput()?>
            <?=$form->field($model, 'repeatPassword')->passwordInput()?>
            <?=$form->field($model, 'email')?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <a href="<?=Url::to(['default/check']);?>"><?=Html::Button(\Yii::t('app', 'pre-step'), ['class' => 'btn btn-primary'])?></a>
            <?=Html::submitButton(\Yii::t('app', 'next'), ['class' => 'btn btn-success'])?>

        </div>
    </div>

    <?php ActiveForm::end();?>
</div>
</section>
