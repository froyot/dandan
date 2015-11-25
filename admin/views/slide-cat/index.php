<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\slideCatForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Slides') . Yii::t('app', 'category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-cat-index">


    <?php echo $this->render('/public/_search', ['model' => $searchModel]);?>


    <?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
['class' => 'yii\grid\SerialColumn'],

'cid',
'cat_name',
'cat_idname',
'cat_remark:ntext',

['class' => 'yii\grid\ActionColumn'],
],
]);?>

</div>
