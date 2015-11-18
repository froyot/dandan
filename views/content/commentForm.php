<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(['id'=>$model->formName()]);?>

<?=$form->field($model, 'content')->textarea(['rows' => 6,'name'=>'content'])->label('comment content');?>

<?=$form->field($model, 'post_id')->hiddenInput(['name'=>'post_id'])->label(false);?>
<?php if( Yii::$app->user->isGuest ):?>
<?=$form->field($model, 'full_name')->textInput(['maxlength' => 255,'name'=>'full_name']);?>
<?=$form->field($model, 'email')->textInput(['maxlength' => 255,'name'=>'email']);?>
<?php endif;?>
<?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
?>

