
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\modules\user\models\Users */

$this->title = Yii::t('app', 'Create users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
