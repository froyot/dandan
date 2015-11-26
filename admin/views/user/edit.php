<?php

/* @var $this yii\web\View */
/* @var $model app\models\action\User */

$this->title = Yii::t('app', 'update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'user list'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="user-update">



    <?=$this->render('_form', [
'model' => $model,
])?>

</div>
