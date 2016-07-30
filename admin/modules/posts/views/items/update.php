
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\posts\models\Posts */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'posts',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?><div class="posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
