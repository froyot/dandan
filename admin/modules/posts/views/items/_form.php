<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model Posts admin\modules\posts\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'abstruct')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'create_at')->render(function($filed){

                return '<div class="has-feedback"><input type="text" class="form-control has-feedback-left datetimeinput"   aria-describedby="inputSuccesscreate_at" value="'.$filed->model->create_at.'" name="'.Html::getInputName($filed->model,"create_at").'">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccesscreate_at" class="sr-only">(success)</span></div>
                      ';
            }) ?>

    <?= $form->field($model, 'update_at')->render(function($filed){

                return '<div class="has-feedback"><input type="text" class="form-control has-feedback-left datetimeinput"   aria-describedby="inputSuccessupdate_at" value="'.$filed->model->update_at.'" name="'.Html::getInputName($filed->model,"update_at").'">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccessupdate_at" class="sr-only">(success)</span></div>
                      ';
            }) ?>

    <?= $form->field($model, 'author_id')->textInput() ?>


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
