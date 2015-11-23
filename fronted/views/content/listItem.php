<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="content-item boder-bottom">
    <a href="<?=Url::to(['post/view','id'=>$model->id]);?>"><h3><?= Html::encode($model->post_title) ?></h3></a>
    <div class="other-info">
        <label class="author"><?=Yii::t('app','author');?>:<?=$model->author->user_login;?></label>
        <label class="date"><?=Yii::t('app','Date');?>:<?=$model->post_date;?></label>
    </div>
    <div class="abstruct-content">
        <?=$model->post_excerpt;?><a href="<?=Url::to(['post/view','id'=>$model->id]);?>">&gt;&gt;&gt;&gt;</a>
    </div>
</div>
