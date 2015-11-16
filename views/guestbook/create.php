<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\action\Guestbook */

$this->title = Yii::t('app', 'Create Guestbook');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guestbooks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guestbook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
