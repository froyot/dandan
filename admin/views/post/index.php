<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\PostForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'postManage');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <?php echo $this->render('/public/_search', ['model' => $searchModel]);?>
    <?=GridView::widget([
'dataProvider' => $dataProvider,

'columns' => [
['class' => 'yii\grid\SerialColumn'],
['attribute' => 'listorder',
'value' => 'postExtra.listorder',
'label' => Yii::t('app', 'order'),
],
'post_title:ntext',
['attribute' => 'cat_name',
'value' => 'postExtra.term.name',
'label' => Yii::t('app', 'cat_name'),
],
'comment_count',
['attribute' => 'post_excerpt',
'value' => function ($model) {
return $model->post_excerpt ? '已设置' : '未设置';
},
],
[
'attribute' => 'post_author',
'value' => 'author.user_login',
],
'post_date',
['attribute' => 'post_status',
'format' => 'raw',
'value' => function ($model) {
$status = $model->post_status ? '已审核' : '未审核';
$top = $model->istop ? '置顶' : '未置顶';
$recommended = $model->recommended ? '推荐' : '未推荐';
return $status . '<br/>' . $top . '<br/>' . $recommended;
},
],
['class' => 'yii\grid\ActionColumn',
'template' => " {update} | {delete}",
'buttons' => [
'update' => function ($url, $model, $key) {
$options = [
'title' => Yii::t('app', 'add submenu'),
'aria-label' => Yii::t('app', 'add submenu'),
'data-pjax' => '0',
];
return Html::a(Yii::t('yii', 'Update'), Url::to(['edit', 'id' => $key]), $options);
},
],
],
],
]);?>

</div>
