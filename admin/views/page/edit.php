<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'page'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="post-update">


    <?=$this->render('_form', [
'model' => $model,
'option' => ['action' => ['update', 'id' => $model->id]],
])?>

</div>
