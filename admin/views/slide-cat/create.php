<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\slideCat */

$this->title = Yii::t('app', 'create') . Yii::t('app', 'Slides') . Yii::t('app', 'category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slides') . Yii::t('app', 'category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-cat-create">



    <?=$this->render('_form', [
'model' => $model,
'option' => ['options' => ['enctype' => 'multipart/form-data']],
])?>

</div>
