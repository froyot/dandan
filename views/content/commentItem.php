<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="comment-item">
    <div class="comment-tips">
        <label class="user" data-uid="<?=$model->uid;?>">
            <?php if($model->uid == 0):?><?=$model->full_name;?>
            <?php else:?>
            <?=$model->user->getNickName();?>
            <?php endif;?>
        </label>
        <?php if($parentUser):?>
            回复
        <label class="parent-user"><?=$parentUser->getNickName();?></label>
        <?php endif;?>
    </div>

    <div class="comment-content">
        <?=$model->content;?>
    </div>
</div>
