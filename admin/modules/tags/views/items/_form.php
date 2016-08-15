<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model Tags admin\modules\tags\models\Tags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tags-form">

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

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
//$bundle = $this->getAssetManager()->getBundle('admin\assets\AdminAsset');
//$this->registerJsFile($bundle->baseUrl.'/vendors/ueditor/utf8-php/ueditor.config.js');
//$this->registerJsFile($bundle->baseUrl.'/vendors/ueditor/utf8-php/ueditor.all.js');
//$this->registerJs('
//    $("#_editor").removeClass("form-control");
//    var _ue = UE.getEditor("_editor",{
//        toolbars: [
//            ["fullscreen", "source", "undo", "redo", "bold","simpleupload","link","justifyleft","justifyright","justifycenter","forecolor","italic","underline","strikethrough"]
//        ],
//        initialFrameHeight:500
//    });
//');

?>
