<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\social\Disqus;
/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <?=$model->content;?>
    <div class="comment-view">
        <?php echo Disqus::widget();?>
    </div>
    <div class="pagination">
    <?php if(isset($links['pre'])):?>
        <ul>上一篇:<a href="<?=$links['pre']['url'];?>" ><?=$links['pre']['title'];?></a></ul>
    <?php endif;?>
    <?php if(isset($links['next'])):?>
        <ul>下一篇:<a href="<?=$links['next']['url'];?>"><?=$links['next']['title'];?></a></ul>
    <?php endif;?>
    </div>

</div>
