<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\action\NavCat */

$this->title = Yii::t('app','create').Yii::t('app','nav cat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','nav cat'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-cat-create">

    <?= $this->render('_form', [
        'model' => $model,
        'option'=>['action'=>Url::to(['nav-cat/update','id'=>$model->navcid])]
    ]) ?>

</div>
