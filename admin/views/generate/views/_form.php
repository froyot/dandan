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

    <?="<?php"?> foreach($model->correlations as $key=>$corretion):<?="?>\n"?>
        <?="<?php"?> if($corretion['type']=='single'):<?="?>\n"?>
           <?="<?php"?> $corretionModel = $model->getCorrelation($key);<?="?>\n"?>
                <div class="form-group field-posts-abstruct">
                <label class="control-label" for="posts-<?="<?="?>$key;<?="?>"?>"><?="<?="?>$key;<?="?>"?></label>
                <?="<?="?> Html::dropDownList( Html::getInputName($model, '_relates').'['.$key.']', $corretionModel?$corretionModel->getPrimaryKey():null,ArrayHelper::map($model->getCorModels($corretion['class']),$corretion['value_key'],$corretion['label_key']),['class'=>'form-control']);<?="?>\n"?>
                <div class="help-block"></div>
                </div>
        <?="<?php"?> endif;<?="?>\n"?>
    <?="<?php"?> endforeach;<?="?>\n"?>

    <div class="form-group">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
