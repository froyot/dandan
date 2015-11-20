<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\common\widgets\CommentWidget;


/* @var $this yii\web\View */
/* @var $model app\models\action\Post */

$this->title = $post->post_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'post list'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-page-view">
    <?=$post->post_content;?>
</div>
<?php

echo CommentWidget::widget([
    'postId'=>$post->id,
    'postTable'=>'posts'
]);
?>
