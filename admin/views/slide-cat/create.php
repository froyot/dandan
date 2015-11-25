<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\slideCat */

$this->title = Yii::t('app', 'Create Slide Cat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slide Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-cat-create">



    <?=$this->render('_form', [
'model' => $model,
'option' => ['options' => ['enctype' => 'multipart/form-data']],
])?>

</div>
