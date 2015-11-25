<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\PostForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'page');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <?php echo $this->render('/public/_search', ['model' => $searchModel]);?>

    <?=GridView::widget([
'dataProvider' => $dataProvider,

'columns' => [
['class' => 'yii\grid\SerialColumn'],
'post_title:ntext',
'post_date',
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
