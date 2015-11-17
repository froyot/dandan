<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\form\NavForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nav-search">
<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-lg-6">
            <div class="input-group">
               <input type="text" class="form-control" value="<?=$model->_keywords;?>" name="_keywords">
               <span class="input-group-btn">
                  <?= Html::submitButton(Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
               </span>
            </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
    <?php ActiveForm::end(); ?>
    <?= Html::a(Yii::t('app','create'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
</div>

</div>
