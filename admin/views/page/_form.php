<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\action\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin($option);?>


    <?=$form->field($model, 'post_title')->textInput(['maxlength' => true])?>

<?=$form->field($model, 'post_content')->widget('allon\yii2\ueditor\Ueditor', [
'options' => [
'serverUrl' => Url::to(['editor/index']),
'toolbars' => [
['fullscreen', 'source', '|', 'undo', 'redo', '|',
'bold', 'italic', 'underline',
'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', 'simpleupload', '|', 'preview'],
],
'autoHeightEnabled' => true,
'autoFloatEnabled' => true,
'mergeEmptyline' => true, //合并空行
'removeClass' => true, //去掉冗余的class
'removeEmptyline' => false, //去掉空行
'textAlign' => "justify", //段落的排版方式，可以是 left，right，center，justify 去掉这个属性表示不执行排版
'imageBlockLine' => 'center', //图片的浮动方式，独占一行剧中，左右浮动，默认: center，left，right，none 去掉这个属性表示不执行排版
'pasteFilter' => false, //根据规则过滤没事粘贴进来的内容
'clearFontSize' => false, //去掉所有的内嵌字号，使用编辑器默认的字号
'clearFontFamily' => false, //去掉所有的内嵌字体，使用编辑器默认的字体
'removeEmptyNode' => false, // 去掉空节点
'indent' => false, // 行首缩进
'indentValue' => '2em', //行首缩进的大小
'bdc2sb' => false,
'tobdc' => false,
'initialFrameHeight' => 500,
'initialStyle' => 'body{line-height:1.5em; font-size: 14px; font-family:黑体;}',
],
'inputOptions' => [
'class' => 'myeditor',
],
// configure additional widget properties here
]);?>
    <?=$form->field($model, 'post_status')->radioList([
0 => Yii::t('app', 'post pass'),
1 => Yii::t('app', 'wait view'),
])?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
