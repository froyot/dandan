<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="content-item" style="border-top:1px dashed #c4c4c4;">
    <a href="<?=Url::to(['content/view','id'=>$model->id]);?>"><h2><?= Html::encode($model->title) ?></h2></a>
    <div class="abstruct-content">
        <?=$model->abstruct;?>
    </div>
    <div class="item-footer">
    <?php
        echo Html::a('<span class="glyphicon glyphicon-eye-open" style="margin-right:1em;"></span>', Url::to(['content/view','id'=>$model->id]), [
                    'title' => Yii::t('yii', 'View'),
                    'data-pjax' => '0',
        ]);
        echo Html::a('<span class="glyphicon glyphicon-pencil" style="margin-right:1em;"></span>', Url::to(['content/update','id'=>$model->id]), [
                    'title' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ]);
        echo Html::a('<span class="glyphicon glyphicon-trash" style="margin-right:1em;"></span>', Url::to(['content/delete','id'=>$model->id]), [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);
    ?>
    </div>
</div>
