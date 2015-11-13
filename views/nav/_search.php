<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\form\NavForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nav-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, '_keywords')->textInput(['name'=>'_keywords']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
