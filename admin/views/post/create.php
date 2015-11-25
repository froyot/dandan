<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'create') . Yii::t('app', 'article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">


    <?=$this->render('_form', [
'model' => $model,
'option' => [],
])?>

</div>
