<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="content-item">
    <a href="<?=Url::to(['post/view','id'=>$model->id]);?>"><h3><?= Html::encode($model->post_title) ?></h3></a>
    <div class="abstruct-content">
        <?=$model->post_excerpt;?>
    </div>
</div>
