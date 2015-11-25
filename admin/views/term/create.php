<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\Term */

$this->title = Yii::t('app', 'create category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-create">

    <?=$this->render('_form', [
'model' => $model,
'option' => [],
])?>

</div>
