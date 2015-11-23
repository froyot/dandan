<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\util\ViewHelper;
/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'friendLink');

$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <?= Html::a(Yii::t('app','create'), ['create-link'], ['class' => 'btn btn-success pull-right']) ?>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><?=Yii::t('app','site_name');?></th><th><?=Yii::t('app','site_url');?></th><th><?=Yii::t('app','open_type');?></th><th></th>
</tr>
</thead>
<tbody>

<?php foreach($modes as $key=> $model):?>
<tr>
    <td><?=$model->site_name;?></td>
    <td><?=$model->site_url;?></td>
    <td>
        <?php if($model->open_type == '_target'):?>
        <?=Yii::t('app','new window');?>
        <?php else:?>
        <?=Yii::t('app','default open');?>
        <?php endif;?>
    </td>
    <td>
    <a href="<?=Url::to(['setting/delete-link','key'=>$key]);?>" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
<?php endforeach;?>
</tbody>
</table>


</div>

