<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\PostForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app',Yii::$app->params['siteConf']['userRole'][$role].'_role').Yii::t('app', 'permission');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('app','role list'),'url'=>['rbac/roles']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-got">
<?= Html::beginForm(['asign-rules'],'post');?>
<input type="hidden" value="<?=$role;?>" name="role">
<ul class="list-group">
<?php foreach($allpermissions as $key => $item):?>
      <div class="checkbox list-group-item">
      <label>
        <input type="checkbox" <?php if(isset($permissions[$key])):?>checked="true"<?php endif;?> value="<?=$key;?>" name="names[]"> <?=Yii::t('app',$item->description);?>
      </label>
   </div>
<?php endforeach;?>
</ul>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>
<?= Html::endForm();?>
</div>


