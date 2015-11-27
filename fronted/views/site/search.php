<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\Content */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app', 'search {_keywords}:', [
    '_keywords' => Yii::$app->request->get('_keywords'),
]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">
    <?=ListView::widget([
'dataProvider' => $dataProvider,
'itemView' => '/content/listItemSearch',
'layout' => "{items}\n{pager}",
]);?>

</div>
