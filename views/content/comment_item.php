<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

?>
<div class="content-item boder-bottom">

    <div class="other-info">
        <label class="author"><?=Yii::t('app','author');?>:
            <?php if($model->uid):?>
                <?=$model->user->user_login;?>
            <?php else:?>
                <?=$model->full_name;?>
            <?php endif;?>
        </label>
    </div>
    <div class="abstruct-content">
        <?=$model->content;?>
    </div>
</div>
