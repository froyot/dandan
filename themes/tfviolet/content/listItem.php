<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="content-item">
    <a href="<?=Url::to(['content/view','id'=>$model->id]);?>"><h2><?= Html::encode($model->title) ?></h2></a>
    <div class="abstruct-content">
        <?=$model->abstruct;?>
    </div>
</div>
