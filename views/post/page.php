<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = $post->post_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-page-view">
    <?=$post->post_content;?>
</div>
