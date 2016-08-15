<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */


echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model <?=StringHelper::basename($modelClass);?> <?= ltrim($modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getSaveColumnNames() as $attribute) {


    echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";


} ?>
    <?php if($generator->correlationable):?>



    <?="<?php"?> foreach($model->correlations as $key=>$corretion):<?="?>\n"?>
        <?="<?php"?> if($corretion['type']=='single'):<?="?>"?>
           <?="<?php"?> $corretionModel = $model->getCorrelation($key);<?="?>\n"?>
                <div class="form-group field-posts-abstruct">
                <label class="control-label" for="posts-<?="<?="?>$key;<?="?>"?>"><?="<?="?>$key;<?="?>"?></label>
                <?="<?="?> Html::dropDownList( Html::getInputName($model, '_relates').'['.$key.']', $corretionModel?$corretionModel->cor_model_id:null,ArrayHelper::map($model->getCorModels($corretion['class']),$corretion['value_key'],$corretion['label_key']),['class'=>'form-control']);<?="?>"?>
                <div class="help-block"></div>
                </div>
        <?="<?php"?> else:<?="?>\n"?>
            <?="<?php"?> foreach($model->getCorrelations($key) as $corretionModel):<?="?>\n"?>
                <div class="form-group field-posts-abstruct">
                <label class="control-label" for="posts-<?="<?="?>$key;<?="?>"?>"><?="<?="?>$key;<?="?>"?></label>
                <?="<?="?> Html::checkbox( Html::getInputName($model, '_relates').'['.$key.'][]', true,['value'=>$corretionModel->cor_model_id,'label'=>$corretionModel->getCorModelName($corretion['class'])."\t"]);<?="?>\n"?>
                <div class="help-block"></div>
                </div>
            <?="<?php"?> endforeach;<?="?>\n"?>

        <?="<?php"?> endif;<?="?>\n"?>
    <?="<?php"?> endforeach;<?="?>\n"?>



    <?php endif;?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

<?="<?php\n"?>
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

<?="?>\n"?>
