<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\NavForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-index">
    <?php echo $this->render('/public/_search', ['model' => $searchModel]);?>

    <?=GridView::widget([
'dataProvider' => $dataProvider,

'columns' => [
['class' => 'yii\grid\SerialColumn'],
'listorder',
'id',
'label',
['class' => 'yii\grid\ActionColumn',
'template' => "{addSub} | {update} | {delete}",
'buttons' => [
'addSub' => function ($url, $model, $key) {
$options = [
'title' => Yii::t('app', 'add submenu'),
'aria-label' => Yii::t('app', 'add submenu'),
'data-pjax' => '0',
];
return Html::a(Yii::t('app', 'add submenu'), Url::to(['create', 'parent' => $key]), $options);
},
],

],
],
]);?>

</div>
