<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */
/* @var $form yii\widgets\ActiveForm */

?>
<?php \yii\widgets\Pjax::begin();?>
<?php $form = ActiveForm::begin([
'id'=>$model->formName(),
'action'=>['post/add-comment'],
'enableAjaxValidation' => true,
'validationUrl' => Url::to(['validate-comment']),
]);?>

<?=$form->field($model, 'content')->textarea(['rows' => 6,'name'=>'content','id'=>'comment_content'])->label(Yii::t('app','comment_content'));?>

<?=$form->field($model, 'post_id')->hiddenInput(['name'=>'post_id'])->label(false);?>
<?php if( Yii::$app->user->isGuest ):?>
<?=$form->field($model, 'full_name')->textInput(['maxlength' => 255,'name'=>'full_name','id'=>'full_name']);?>
<?=$form->field($model, 'email')->textInput(['maxlength' => 255,'name'=>'email']);?>
<?php endif;?>
<?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
?>
 <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end();?>
<?php $this->registerJs("
$('body').on('beforeSubmit', 'form#{$model->formName()}', function () {
     var form = $(this);
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     var data = form.serialize();
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: data,
          success: function (response) {
              if(response.success == true)
              {
                var user = '您';
                if($('#full_name').length > 0)
                {
                  user = $('#full_name').val();
                }
                var content = $('#comment_content').val();
                var comment = \"<div data-key='0'><div class='content-item boder-bottom'>\";
                    comment += \"<div class='other-info'>\";
                    comment += \"<label class='author'>作者:\"+user+\"</label>\";
                    comment += \"</div>\";
                    comment += \"<div class='abstruct-content'>\"+content+\"</div>\";
                    comment += \"</div>\";
                $('.list-view').prepend(comment);
                $('form#{$model->formName()}')[0].reset();
                alert('评论成功,感谢您的评论');
              }
          }
     });
     return false;
});
");

