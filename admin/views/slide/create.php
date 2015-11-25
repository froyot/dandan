<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\slide */

$this->title = Yii::t('app', 'create') . Yii::t('app', 'Slides');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-create">

    <?=$this->render('_form', [
'model' => $model,
'option' => ['options' => ['enctype' => 'multipart/form-data']],
])?>

</div>
