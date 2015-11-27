<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\TermForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-index">

    <?php echo $this->render('/public/_search', ['model' => $searchModel]);?>
    <?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
['class' => 'yii\grid\SerialColumn'],
'term_id',
'name',
['attribute' => 'taxonomy',
'value' => function ($model) {
return Yii::t('app', $model->taxonomy);
},
],
[
'class' => 'yii\grid\ActionColumn',
'template' => '{addSub} | {update} | {delete}',
'buttons' => [
'addSub' => function ($url, $model, $key) {
$options = [
'title' => Yii::t('app', 'add sub cat'),
'aria-label' => Yii::t('app', 'add sub cat'),
'data-pjax' => '0',
];
return Html::a(Yii::t('app', 'add sub cat'), Url::to(['create', 'parent' => $key]), $options);
},
],
],
],
]);?>

</div>
