<?php

use app\models\util\Tree;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\action\Term */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="term-form">

    <?php $form = ActiveForm::begin($option);?>
    <?=$form->field($model, 'parent')->dropDownList(Tree::makeDropDown([
'model' => 'app\models\action\term',
'parentKey' => 'parent',
'primaryKey' => 'term_id',
'rootParent' => 0,
],
[
'value' => 'term_id',
'label' => 'name',
'icon' => '├─',
'levelChar' => '    ',
]
), [
'name' => 'parent',
'encodeSpaces' => true,
'prompt' => '--' . Yii::t('app', 'select') . Yii::t('app', 'parent cat') . '--',
])?>
    <?=$form->field($model, 'name')->textInput(['maxlength' => true, 'name' => 'name'])?>

    <?=$form->field($model, 'taxonomy')->dropDownList([
'article' => Yii::t('app', 'article'),
'img' => Yii::t('app', 'img'),
], ['name' => 'taxonomy'])?>
    <?=$form->field($model, 'description')->textarea(['rows' => 6, 'name' => 'description'])?>



    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
