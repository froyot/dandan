<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Content */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <?=$model->content;?>

    <div class="pagination">
    <?php if(isset($links['pre'])):?>
        <a href="<?=$links['pre']['url'];?>"><?=$links['pre']['title'];?></a>
    <?php endif;?>
    <?php if(isset($links['next'])):?>
        <a href="<?=$links['next']['url'];?>"><?=$links['next']['title'];?></a>
    <?php endif;?>
</div>

</div>
