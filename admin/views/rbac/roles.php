<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\PostForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'role list');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">
    <ul class="list-group">
<?php foreach (Yii::$app->authManager->getAllRoles() as $key => $item): ?>
<a href="<?=Url::to(['rbac/get-rules', "role" => $key]);?>" class="list-group-item"><?=Yii::t('app', $item->name . '_role');?></a>
<?php endforeach;?>
</ul>
</div>
