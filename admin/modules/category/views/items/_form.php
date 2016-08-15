<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model Category admin\modules\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([ 'post' => 'Post', 'goods' => 'Goods', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'des')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Not Used', 'Used', ]) ?>

    <?= $form->field($model, 'create_at')->render(function($filed){

                return '<div class="has-feedback"><input type="text" class="form-control has-feedback-left datetimeinput"   aria-describedby="inputSuccesscreate_at" value="'.$filed->model->create_at.'" name="'.Html::getInputName($filed->model,"create_at").'">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccesscreate_at" class="sr-only">(success)</span></div>
                      ';
            }) ?>

    <?= $form->field($model, 'sort_num')->textInput() ?>


    <?php foreach($model->correlations as $key=>$corretion):?>
        <?php if($corretion['type']=='single'):?>
           <?php $corretionModel = $model->getCorrelation($key);?>
                <div class="form-group field-posts-abstruct">
                <label class="control-label" for="posts-<?=$key;?>"><?=$key;?></label>
                <?= Html::dropDownList( Html::getInputName($model, '_relates').'['.$key.']', $corretionModel?$corretionModel->getPrimaryKey():null,ArrayHelper::map($model->getCorModels($corretion['class']),$corretion['value_key'],$corretion['label_key']),['class'=>'form-control']);?>
                <div class="help-block"></div>
                </div>
        <?php endif;?>
    <?php endforeach;?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
