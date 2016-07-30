
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\modules\posts\models\Posts */

$this->title = Yii::t('app', 'Create posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
