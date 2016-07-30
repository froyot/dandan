
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\user\models\Users */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'users',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?><div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
