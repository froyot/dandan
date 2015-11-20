<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">


    <?= $this->render('_form', [
        'model' => $model,
        'option'=>[]
    ]) ?>

</div>
