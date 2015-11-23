<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\form\Content */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $breadcrum;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView'=>'/content/listItem',
        'layout' => "{items}\n{pager}"
    ]); ?>

</div>
