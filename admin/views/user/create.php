<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\User */

$this->title = Yii::t('app', 'create user');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'user'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">



    <?=$this->render('_form', [
'model' => $model,
])?>

</div>
