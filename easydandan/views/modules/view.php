<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Attr */

$this->title = $model->getPrimaryKey();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'View Detail ').$this->title;
?>
<div class="view">

    <h1><?=Html::encode($this->title)?></h1>

<?=DetailView::widget([
'model' => $model,
'attributes' => array_keys($model->attributes),
])?>

</div>
