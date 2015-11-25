<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\slide */

$this->title = Yii::t('app', 'update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slides'), 'url' => ['index']];

$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="slide-update">
    <?=$this->render('_form', [
'model' => $model,
'option' => ['action' => ['slide/update', 'id' => $model->getPrimaryKey()],
'options' => ['enctype' => 'multipart/form-data']],
])?>

</div>
