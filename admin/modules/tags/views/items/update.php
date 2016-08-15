
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\tags\models\Tags */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'tags',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?><div class="tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
