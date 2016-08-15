
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\modules\tags\models\Tags */

$this->title = Yii::t('app', 'Create tags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
